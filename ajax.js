// Selecionando o elemento jQuery para eventPhoto
const eventPhoto = $("#event-photo");

const dateFomater = (args) =>{
    const date = new Date(args)
    const formater = new Intl.DateTimeFormat("pt-br",{
        dateStyle: "short",
        timeStyle: "medium"
    })

    return formater.format(date).replaceAll("/", '-',).replace(",", "").replaceAll(" ", "-").replaceAll(":", "-")

}

// Função para verificar a imagem
const imageChecker = (imageUrl, imageSize, fileSize) => {
    return new Promise((resolve, reject) => {
        const { width, height } = imageSize;
        const aspectRatio = width / height;

        if (fileSize > 2 * (Math.pow(1024, 2))) {
            reject(alert("Imagem muito pesada, o arquivo enviado excede 2MB"))
        }
        else if (!Math.abs(aspectRatio - (16 / 9) < 0.01) && !Math.abs(aspectRatio - (16 / 10) < 0.01)) {
            reject(alert("Imagem fora das proporções adequadas, favor enviar uma imagem em 16:9 ou 16:10")
            );

        }
        else if (width < height || width === height) {
            reject(alert("A imagem deve ser horizontal"))
        }
        else {
            resolve(imageUrl)
        }
    })
};



// Evento onchange para eventPhoto
eventPhoto.on('change', () => {
    const file = eventPhoto[0].files[0];
    if (file) {
        const img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = async () => {
            try {
                await imageChecker(img.src, img, file.size);
                $("#img").attr("src", img.src);

            } catch (error) {
                eventPhoto.val('');
                $("#img").attr("src", '');
            }
        };
    }
});

// Evento submit para o formulário
$("#form").on('submit', async e => {
    e.preventDefault();


    try {
        const file = eventPhoto[0].files[0];

        const eventTitle = $("#event-title").val();
        const eventDescription = $("#event-description").val();
        const eventDateTime = $("#event-datetime").val();
        const eventDuration = $("#event-duration").val();

        const renamedFile = new File([file], `${eventTitle}-${dateFomater(eventDateTime)}_photo.${file.name.split('.').pop()}`,{
            type: file.type,
        })
    
        if (!file || !eventTitle || !eventDescription || !eventDateTime) {
            console.error("Favor preencher todos os dados");
            return;
        }
        
        const formData = new FormData($("#form")[0]);
        formData.append('eventTitle', eventTitle);
        formData.append('eventDescription', eventDescription);
        formData.append('eventDateTime', eventDateTime);
        formData.append('eventDuration', eventDuration);
        formData.append('eventPhoto', renamedFile);

        $.ajax({
            type: "post",
            url: "App.php",
            contentType: false,
            processData: false,
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.code === 200)
                    console.log(response.mensagem);
                else if (response.code === 500 || response.code === 409) {
                    console.log(response.mensagem);
                    return;
                } else {
                    console.log(response.mensagem);
                    return;
                }
            },
            error: (status, error, xhr) => {
                console.error(`status: ${status}\nerror: ${error}\nxhr: ${xhr}`);
            }
        });
    } catch (error) {
        console.error(`Erro ao enviar o formulário: ${error}`);
    }
});
