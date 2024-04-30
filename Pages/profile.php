<?php
    session_start();

    if (!isset($_SESSION['id']))
    {
        header('location: login');
    }

    include "../classes/dbh.classes.php";
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-view.classes.php";

    $profileInfo = new ProfileInfoView();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['uid'] ?></title>
    <style>
        /* Hides scrollbar while still allowing scrolling */
        textarea {
        overflow: auto;
        scrollbar-width: none; /* For Firefox */
        -ms-overflow-style: none; /* For Internet Explorer and Edge */
        }

        textarea::-webkit-scrollbar {
        display: none; /* For Chrome, Safari, and other Webkit-based browsers */
        }
    </style>
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class=" flex justify-center items-center h-screen bg-slate-100">
    <form action="includes/profileinfo.inc.php" method="post" enctype="multipart/form-data">
        <div class=" w-[820px] mx-auto h-[500px] bg-indigo-500 shadow-lg rounded-lg shadow-slate-200 relative cursor-default overflow-hidden">
            <div class="relative p-2 w-full h-[150px] bg-[#1f1f1f] rounded-t-lg after:content-[''] after:bg-transparent after:block after:w-[25px] after:h-[50px] after:absolute after:top-[150px] after:left-[12.038px] after:rounded-tr-full after:shadow-borderL before:content-[''] before:bg-transparent before:block before:w-[25px] before:h-[50px] before:absolute before:top-[150px] before:left-[193.238px] before:rounded-tl-full before:shadow-borderR">
                <h1 class=" text-[50px] text-indigo-500 font-bold absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">Chat Online</h1>
                <button type="submit" class="group transition ease-in-out duration-500 hover:text-black hover:bg-emerald-500 absolute right-[20px] top-[50%] translate-y-[-50%] bg-transparent text-white px-8 py-2 border border-white hover:border-emerald-500 rounded-md text-xl cursor-pointer"><pre>Save  <i class="fa-regular fa-floppy-disk text-white transition ease-in-out duration-500 group-hover:text-black"></i></pre></button>
            </div>
            <img id="profileImg" src="<?php echo ( $profileInfo->fetchProfileImgStatus($_SESSION['id']) == 0 ) ? 'assets/Profile.jpg' : 'assets/uploads/Profile'.$_SESSION['id'].'.png?'.mt_rand() ?>" alt="Profile" class=" rounded-full w-[150px] h-[150px] absolute top-[70px] left-[40px] outline-8 outline outline-[#1f1f1f]">
            <div class=" absolute top-[180px] left-[150px]">
                <input type="file" name="image" class=" hidden" id="fileUpload" accept="image/*">
                <button type="button" onclick="document.getElementById('fileUpload').click();" class="group transition ease-in-out duration-500 hover:bg-blue-500 bg-white w-10 h-10 rounded-full"><i class="fa-solid fa-arrow-up-from-bracket transition ease-in-out duration-500 group-hover:text-white"></i></button>
            </div>
            <h5 class=" ml-[220px] mt-[12px] text-2xl text-slate-200">
                <b class="text-white">Username: </b>
                <input type="text" name="uid" value="<?php echo $_SESSION['uid'] ?>" class=" bg-indigo-500 w-[130px] h-[40px] p-3 border-b border-slate-300 outline-none">
            </h5>
            <div class=" flex flex-row p-2">
                <div class="shrink-0">
                    <h5 class=" ml-[20px] mt-[60px] text-2xl text-slate-200">
                        <b class="text-white">First Name: </b>
                        <input type="text" name="Fname" value="<?php $profileInfo->fetchFirstName($_SESSION['id']) ?>" class=" bg-indigo-500 w-[130px] h-[40px] p-3 border-b border-slate-300 outline-none">
                    </h5>
                    <h5 class=" ml-[20px] mt-[32px] text-2xl text-slate-200">
                        <b class="text-white">Last Name: </b>
                        <input type="text" name="Lname" value="<?php $profileInfo->fetchLastName($_SESSION['id']) ?>" class=" bg-indigo-500 w-[130px] h-[40px] p-3 border-b border-slate-300 outline-none">
                    </h5>
                    <h5 class=" ml-[20px] mt-[32px] text-2xl text-slate-200">
                        <b class="text-white">Join Date: </b>
                        <?php echo $_SESSION['Djoin'] ?>
                    </h5>
                </div>
                <div>
                    <h5 class=" ml-[50px] mt-[60px] text-xl p-2 text-slate-200">
                        <b class="text-white">About: </b>
                        <br>
                        <div class=" bg-black relative w-[420px] h-[140px]">
                            <textarea name="about" maxlength="150" oninput="updateCharCount()" id="about" class="bg-indigo-500 p-2 outline-white border-none outline-[0.2px] w-[420px] h-[140px] resize-none"><?php $profileInfo->fetchAbout($_SESSION['id']) ?></textarea>
                            <p id="charCount" class=" absolute bottom-[5px] right-[10px]">0/150</p>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
    </form>

    <script>
        function updateCharCount() {
            const textarea = document.getElementById("about");
            const charCountDisplay = document.getElementById("charCount");
            const currentLength = textarea.value.length;
            charCountDisplay.innerText = `${currentLength}/150`;
        }

        // Initialize the character count on page load
        document.addEventListener("DOMContentLoaded", updateCharCount);

        // Display image
        document.getElementById("fileUpload").addEventListener("change", function() {
        const fileInput = document.getElementById("fileUpload");

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0]; // Get the selected file
            const reader = new FileReader(); // Create a FileReader instance

            reader.onload = function(event) { // When the file is read
            const img = document.getElementById('profileImg')
            img.src = event.target.result; // Set the source to the FileReader result

            };

            reader.readAsDataURL(file); // Read the file as a Data URL
        }
        });


    </script>
</body>
</html>