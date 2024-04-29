<?php 
    session_start();

    if (!isset($_SESSION['id']))
    {
        header('location: login');
    }
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
    <div class="changeToBlur w-[100%] mx-auto h-[100%] flex flex-col justify-center items-center shadow-md rounded-lg shadow-slate-200 p-6 relative bg-indigo-500">
        <div class=" text-white font-semibold">
            <h1>Welcome </h1>
            <h1><?php echo $_SESSION['uid'] ?></h1>
        </div>
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
                                <h1 class=" text-3xl font-semibold text-slate-900">You loged in successfully.</h1>
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
</body>
</html>