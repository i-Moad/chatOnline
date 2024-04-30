<?php 
    session_start();

    if (!isset($_SESSION['id']))
    {
        header('location: login');
    }

    include "classes/dbh.classes.php";
    include "classes/profileinfo.classes.php";
    include "classes/profileinfo-view.classes.php";

    $profileInfo = new ProfileInfoView();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="body flex justify-center items-center h-screen bg-slate-100">
    <div class="changeToBlur w-[100%] mx-auto h-[100%] flex flex-col justify-center items-center shadow-md shadow-slate-200 p-6 relative bg-indigo-500">
        <div class=" text-white font-semibold">
            <h1>Welcome </h1>
            <h1><?php echo $_SESSION['uid'] ?></h1>
        </div>
        <button onclick="showProfile()" class=" transition ease-in-out duration-500 hover:text-black mt-[100px] bg-white text-indigo-500 px-8 py-2 rounded-lg text-xl cursor-pointer">Profile</button>
        <a href="includes/logout.inc.php" class=" transition ease-in-out duration-500 hover:text-black mt-[100px] bg-white text-indigo-500 px-8 py-2 rounded-lg text-xl cursor-pointer"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <?php
        if (isset($_SESSION['login']))
        {
    ?>
            <script>
                document.querySelector('.changeToBlur').classList.add('blur-md');
                document.querySelector('.body').innerHTML += `
                    <div class="popup w-[100%] h-[100%] bg-gray-700 opacity-[0.95] absolute">
                        <div class=" w-[100%] h-[100%] relative">
                            <div class=" min-w-[550px] max-w-[550px] min-h-[350px] max-h-[350px] border bg-white border-gray-200 rounded-lg absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] flex flex-col justify-center items-center p-6 gap-7">
                                <h1 class=" text-3xl font-semibold text-slate-900">You've logged in successfully.</h1>
                                <i class="fa-solid fa-check text-emerald-400 text-[100px]"></i>
                                <button onclick="popUp()" class=" transition ease-in-out duration-500 hover:bg-indigo-400 bg-indigo-500 text-white px-8 py-2 rounded-lg text-xl">Get Started!</button>
                            </div>
                        </div>
                    </div>
                `
                function popUp()
                {
                    document.querySelector('.popup').remove()
                    document.querySelector('.changeToBlur').classList.remove('blur-md')
                }
            </script>
    <?php
        }
        unset($_SESSION['login']);
    ?>

    <script>
        function showProfile()
        {
            document.querySelector('.changeToBlur').classList.add('blur-md');
            document.querySelector('.body').innerHTML += `
                <div class="popup w-[100%] h-[100%] bg-gray-700 opacity-[0.95] absolute">
                    <div class=" w-[55%] mx-auto h-[500px] my-auto bg-indigo-500 shadow-lg rounded-lg absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] cursor-default">
                        <div class="relative p-2 w-full h-[150px] bg-[#1f1f1f] rounded-t-lg after:content-[''] after:bg-transparent after:block after:w-[25px] after:h-[50px] after:absolute after:top-[150px] after:left-[11.038px] after:rounded-tr-full after:shadow-borderL before:content-[''] before:bg-transparent before:block before:w-[25px] before:h-[50px] before:absolute before:top-[150px] before:left-[193.238px] before:rounded-tl-full before:shadow-borderR">
                            <button onclick="popUp()" class=" px-4 absolute top-[20px] left-[15px]"><i class="fa-solid fa-arrow-left text-white text-2xl"></i></button>
                            <h1 class=" text-[50px] text-indigo-500 font-bold absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">Chat Online</h1>
                            <a href="profile" class="group transition ease-in-out duration-500 hover:text-black hover:bg-white absolute right-[20px] top-[50%] translate-y-[-50%] bg-transparent text-white px-8 py-2 border border-white rounded-md text-xl cursor-pointer"><pre>Edit  <i class="fa-regular fa-pen-to-square text-white transition ease-in-out duration-500 group-hover:text-black"></i></pre></a>
                        </div>
                        <img id="profileImg" src="<?php echo ( $profileInfo->fetchProfileImgStatus($_SESSION['id']) == 0 ) ? 'assets/Profile.jpg' : 'assets/uploads/Profile'.$_SESSION['id'].'.png?'.mt_rand() ?>" alt="Profile" class=" rounded-full w-[150px] h-[150px] absolute top-[70px] left-[40px] outline-8 outline outline-[#1f1f1f]">
                        <h5 class=" ml-[220px] mt-[12px] text-2xl text-slate-200"><b class="text-white">Username: </b> <?php echo $_SESSION['uid'] ?></h5>
                        <div class=" flex flex-row ">
                            <div class="p-6 shrink-0">
                                <h5 class=" ml-[20px] mt-[60px] text-2xl text-slate-200"><b class="text-white">First Name: </b> <?php $profileInfo->fetchFirstName($_SESSION['id']) ?></h5>
                                <h5 class=" ml-[20px] mt-[32px] text-2xl text-slate-200"><b class="text-white">Last Name: </b> <?php $profileInfo->fetchLastName($_SESSION['id']) ?></h5>
                                <h5 class=" ml-[20px] mt-[32px] text-2xl text-slate-200"><b class="text-white">Join Date: </b> <?php echo $_SESSION['Djoin'] ?></h5>
                            </div>
                            <div>
                                <h5 class=" ml-[50px] mt-[60px] text-xl p-2 text-slate-200"><b class="text-white">About: </b><br><?php $profileInfo->fetchAbout($_SESSION['id']) ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            `
        }

        function popUp()
        {
            document.querySelector('.popup').remove()
            document.querySelector('.changeToBlur').classList.remove('blur-md')
        }
    </script>
</body>
</html>