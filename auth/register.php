<?php
session_start();
if (isset($_SESSION['luxin_user'])) {
  header('location: ../user_pages/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Luxin Boost - Sign Up</title>
  <link rel="shortcut icon" href="../assets/images/logo/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="../assets/fonts/basic/boxicons.min.css" />
  <script src="../assets/tailwind.js"></script>
  <style>
    .ipt-box {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .ipt-box input {
      outline: none;
      padding: 10px;
      width: 100%;
      background: #00000010;
      border-radius: 6px;
    }

    .ipt-box label {
      margin-top: 10px;
      font-weight: 600;
    }

    .ipt-box input::placeholder {
      -webkit-text-fill-color: rgba(0, 0, 0, 0.692);
    }

    .info-container {
      display: block;
    }

    .title {
      font-size: 2.2rem;
    }

    @media (max-width: 1080px) {
      .info-container {
        display: none;
      }

      .title {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body class="flex items-center justify-center px-6" style="min-height: 100vh">
  <?php
  include 'notification.php';
  ?>
  <nav class="fixed top-0 left-0 w-full px-6 py-3">
    <ul class="w-full flex items-center justify-between">
      <li class="font-semibold">
        <a href="../" class="items-center justify-start flex max-w-4"><i class="bx bx-arrow-left text-3xl"></i> Back</a>
      </li>
      <li class="font-semibold">
        <a href="login" class="hover:underline">Sign In</a>
      </li>
    </ul>
  </nav>
  <main class="flex gap-40 flex-row items-center-center justify-center pt-16 pb-4">
    <div class="form-container flex flex-col items-center-center justify-center">
      <div class="logo w-full flex items-center justify-center mb-2">
        <img src="../assets/images/logo.webp" class="rounded-full" style="height: 100px; width: 100px" alt="" />
      </div>
      <h1 class="font-bold title text-center sm:text-start text-blue-600">
        Join our commuity.
      </h1>
      <p class="mb-1 text-md">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
      </p>
      <form action="">
        <div class="ipt-box">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="ipt-box">
          <label for="username">Username:</label>
          <input type="text" id="username" name="userName" placeholder="Enter your username" required />
        </div>
        <div class="ipt-box">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required />
        </div>
        <span>Password must be at least 8 characters long.</span>
        <div class="ipt-box">
          <label for="confirm-password">Confirm Password:</label>
          <input type="password" name="comfirm_password" id="confirm-password" placeholder="Confirm your password"
            required />
        </div>
        <div class="checkbox-container py-3">
          <input type="checkbox" id="terms" name="terms" required />
          <label for="terms">I agree to the
            <a href="#" class="text-blue-600 hover:underline">terms and conditions</a></label>
        </div>
        <button id="buttonsub" class="bg-black/90 hover:bg-black text-slate-50 w-full py-3 rounded-lg" type="submit">
          Create free account.
        </button>
      </form>
    </div>
    <div class="info-container">
      <img src="../assets/images/colour.png" class="w-96 select-none" alt="" />
    </div>
  </main>
  <script>
    const form = document.querySelector("form"),
      continueBtn = form.querySelector("#buttonsub");
    const errorText = document.querySelector(".error-txt");
    const errorBox = document.querySelector(".error-box");

    form.onsubmit = (e) => {
      e.preventDefault();
    };

    continueBtn.onclick = () => {
      // Show loading animation immediately when button is clicked
      const originalText = continueBtn.innerHTML;
      continueBtn.innerHTML = `<svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
</svg>
Loading...`;

      // Disable the button to prevent multiple clicks
      continueBtn.disabled = true;

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "php/register", true);

      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            let data = xhr.response;
            if (data == "success") {
              // Show success message
              continueBtn.innerHTML = "✓ Account created";

              // Redirect after showing success message
              setTimeout(() => {
                location.href = "validate";
              }, 2000);

              // Hide any error messages
              errorBox.style.display = "none";
            } else {
              // Show error and restore button
              continueBtn.innerHTML = originalText;
              continueBtn.disabled = false;

              errorText.textContent = data;
              errorBox.style.display = "flex";

              setTimeout(() => {
                errorBox.style.display = "none";
              }, 2500);
            }
          } else {
            // Handle HTTP errors
            continueBtn.innerHTML = originalText;
            continueBtn.disabled = false;

            errorText.textContent = "Network error. Please try again.";
            errorText.style.display = "flex";

            setTimeout(() => {
              errorText.style.display = "none";
            }, 2500);
          }
        }
      };

      xhr.onerror = () => {
        // Handle network errors
        continueBtn.innerHTML = originalText;
        continueBtn.disabled = false;

        errorText.textContent = "Connection failed. Please try again.";
        errorText.style.display = "flex";

        setTimeout(() => {
          errorText.style.display = "none";
        }, 2500);
      };

      let formData = new FormData(form);
      xhr.send(formData);
    };
  </script>
</body>

</html>