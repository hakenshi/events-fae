def calculate_dimensions(width, ratio="16:10"):
    # Extracting width and height ratios
    ratio_parts = ratio.split(":")
    ratio_width = int(ratio_parts[0])
    ratio_height = int(ratio_parts[1])

    # Calculating height based on width and ratio
    height = (width * ratio_height) / ratio_width
    return width, height

def main():
    try:
        width = float(input("Enter the width of the image: "))
        if width <= 0:
            raise ValueError("Width must be a positive number.")
        
        # Calculate dimensions
        dimensions = calculate_dimensions(width)
    
        print(f"Image dimensions (16:9 ratio): {dimensions[0]}x{dimensions[1]}")
    except ValueError as ve:
        print(f"Error: {ve}")

if __name__ == "__main__":
    main()
