
document.addEventListener("DOMContentLoaded", function () {
    function handleImageChange(inputId, errorId, expectedWidth, expectedHeight) {
        const input = document.getElementById(inputId);
        const errorElement = document.getElementById(errorId);

        if (!input || !errorElement) {
            return;
        }

        const file = input.files[0];
        errorElement.textContent = "";
        input.removeAttribute("data-invalid");
        input.removeAttribute("data-validating");

        if (!file) return;

        if (!file.type.startsWith("image/")) {
            errorElement.textContent = "Please select a valid image.";
            input.value = "";
            input.setAttribute("data-invalid", "true");
            return;
        }

        input.setAttribute("data-validating", "true");
        const objectURL = URL.createObjectURL(file);
        const img = new Image();

        img.onload = function () {
            const imgWidth = img.width;
            const imgHeight = img.height;
            URL.revokeObjectURL(objectURL);

            if (imgWidth !== expectedWidth || imgHeight !== expectedHeight) {
                errorElement.textContent =
                    `Image dimensions must be exactly ${expectedWidth}x${expectedHeight}. Selected image: ${imgWidth}x${imgHeight}.`;
                input.value = "";
                input.setAttribute("data-invalid", "true");
            } else {
                errorElement.textContent = "";
                input.removeAttribute("data-invalid");
            }
            input.removeAttribute("data-validating");
        };

        img.onerror = function () {
            URL.revokeObjectURL(objectURL);
            errorElement.textContent = "Unable to load image. Please select another image.";
            input.value = "";
            input.setAttribute("data-invalid", "true");
            input.removeAttribute("data-validating");
        };

        img.src = objectURL;
    }

    for (let i = 1; i <= 3; i++) {
        const inputId = `image${i}`;
        const errorId = `image_error${i}`;
        const inputElement = document.getElementById(inputId);

        if (inputElement) {
            inputElement.addEventListener("change", function () {
                handleImageChange(inputId, errorId, 1400, 600);
            });
        }
    }

    for (let i = 1; i <= 3; i++) {
        const inputId = `mob_img${i}`;
        const errorId = `mob_img_error${i}`;
        const inputElement = document.getElementById(inputId);

        if (inputElement) {
            inputElement.addEventListener("change", function () {
                handleImageChange(inputId, errorId, 768, 1000);
            });
        }
    }

    const blogImage = document.getElementById("image");
    if (blogImage) {
        blogImage.addEventListener("change", function () {
            handleImageChange("image", "image_error", 651, 434);
        });
    }

    ["cms-banner-form", "blog-post-form"].forEach(function (formId) {
        const form = document.getElementById(formId);
        if (!form) return;

        form.addEventListener("submit", function (event) {
            const invalidInput = form.querySelector('input[type="file"][data-invalid="true"]');
            if (invalidInput) {
                event.preventDefault();
                invalidInput.focus();
            } else if (form.querySelector('input[type="file"][data-validating="true"]')) {
                event.preventDefault();
            }
        });
    });
});
