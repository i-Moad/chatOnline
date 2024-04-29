<?php
    session_start();

    if (isset($_SESSION['id']))
    {
        header("Location: ../home");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="body flex justify-center items-center h-screen bg-slate-100">
    <div class="changeToBlur w-[84%] mx-auto h-[700px] bg-white shadow-md rounded-lg shadow-slate-200 p-6 grid grid-cols-12 relative">
        <div class="col-start-1 col-end-7 rounded-lg flex flex-col justify-center items-center gap-12">
            <h2 class=" font-semibold text-4xl">Sign up</h2>
            <form action="includes/signup.inc.php" method="post" class=" flex flex-col gap-2 w-[75%]">
                <div class=" relative">
                    <input type="text" name="Fname" placeholder="First Name" class=" w-[95%] mx-auto h-[40px] p-3 border-b border-slate-300 outline-none mb-3">
                    <i class="fa-solid fa-user absolute bottom-[20px] right-[23px]"></i>
                </div>
                <div class=" relative">
                    <input type="text" name="Lname" placeholder="Last Name" class=" w-[95%] mx-auto h-[40px] p-3 border-b border-slate-300 outline-none mb-3">
                    <i class="fa-solid fa-user absolute bottom-[20px] right-[23px]"></i>
                </div>
                <div class=" relative">
                    <input type="text" name="uid" placeholder="Username" class=" w-[95%] mx-auto h-[40px] p-3 border-b border-slate-300 outline-none mb-3">
                    <i class="fa-solid fa-user absolute bottom-[20px] right-[23px]"></i>
                </div>
                <div class=" relative">
                    <input type="email" name="email" placeholder="Email" class=" w-[95%] mx-auto h-[40px] p-3 border-b border-slate-300 outline-none mb-3">
                    <i class="fa-solid fa-envelope absolute bottom-[20px] right-[23px]"></i>
                </div>
                <div class=" relative">
                    <input type="password" name="password" placeholder="Password" class=" w-[95%] mx-auto h-[40px] p-3 border-b border-slate-300 outline-none mb-3">
                    <i class="fa-solid fa-lock absolute bottom-[20px] right-[23px]"></i>
                </div>
                <div class=" relative">
                    <input type="password" name="cpassword" placeholder="Confirm Password" class=" w-[95%] mx-auto h-[40px] p-3 border-b border-slate-300 outline-none mb-3">
                    <i class="fa-solid fa-lock absolute bottom-[20px] right-[23px]"></i>
                </div>
                    <input type="submit" value="Sign Up" class=" transition ease-in-out duration-300 bg-indigo-500 hover:bg-indigo-400 w-[45%] mx-auto p-2 rounded-md text-white font-semibold mt-4 cursor-pointer">
            </form>
            <div class=" flex flex-col gap-2 w-[75%] -mt-4">
                <div class=" grid grid-cols-or items-center">
                    <hr class=" border-slate-300">
                    <p class=" justify-self-center text-slate-400">Or</p>
                    <hr class=" border-slate-300">
                </div>
                <div class=" flex flex-row gap-x-8 text-2xl justify-center items-center mt-3">
                    <a href="#" class=" transition ease-in-out duration-300 hover:text-indigo-500">
                        <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="#" class=" transition ease-in-out duration-300 hover:text-indigo-500">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class=" transition ease-in-out duration-300 hover:text-indigo-500">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="#" class=" transition ease-in-out duration-300 hover:text-indigo-500">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class=" col-start-7 col-end-13 rounded-lg flex flex-col justify-center items-center gap-12">
            <h2 class=" font-semibold text-4xl">Login</h2>
            <form action="includes/login.inc.php" method="post" class=" flex flex-col gap-2 w-[75%]">
                <div class=" relative">
                    <input type="email" name="email" placeholder="Email" class=" w-[95%] mx-auto h-[40px] p-3 border-b border-slate-300 outline-none mb-3">
                    <i class="fa-solid fa-envelope absolute bottom-[20px] right-[23px]"></i>
                </div>
                <div class=" relative">
                    <input type="password" name="password" placeholder="Password" class=" w-[95%] mx-auto h-[40px] p-3 border-b border-slate-300 outline-none mb-3">
                    <i class="fa-solid fa-lock absolute bottom-[20px] right-[23px]"></i>
                </div>
                <a href="#" class=" underline">Forget Your Password ?</a>
                <input type="submit" value="Login" class=" transition ease-in-out duration-300 bg-indigo-500 hover:bg-indigo-400 w-[45%] mx-auto p-2 rounded-md text-white font-semibold mt-4 cursor-pointer">
            </form>
            <div class=" flex flex-col gap-2 -mt-4 w-[75%]">
                <div class=" grid grid-cols-or items-center">
                    <hr class=" border-slate-300">
                    <p class=" justify-self-center text-slate-400">Or</p>
                    <hr class=" border-slate-300">
                </div>
                <div class=" flex flex-row gap-x-8 text-2xl justify-center items-center mt-3">
                    <a href="#" class=" transition ease-in-out duration-300 hover:text-indigo-500">
                        <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="#" class=" transition ease-in-out duration-300 hover:text-indigo-500">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class=" transition ease-in-out duration-300 hover:text-indigo-500">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="#" class=" transition ease-in-out duration-300 hover:text-indigo-500">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class=" change_pos w-[50%] h-[100%] bg-indigo-500 absolute rounded-lg flex flex-col gap-40 justify-center items-center right-0 text-center text-white font-semibold text-3xl p-28">
            <div class=" -mt-[50px]">
                <p>Welcome TO</p>
                <p>ChatOnline</p>
            </div>
            <div>
                <p>Create An Account To Get Started With Us.</p>
                <br>
                <p>If You Already Have An Account Just</p>
                <button onclick="ChangePosition()" class=" transition ease-in-out duration-500 hover:text-black mt-[100px] bg-white text-indigo-500 px-8 py-2 rounded-lg text-xl"><i class="fa-solid fa-arrow-left"></i> Sign IN</button>
            </div>
        </div>
    </div>

    

    <?php
        if (isset($_SESSION['signup']))
        {
    ?>
            <script>
                document.querySelector('.changeToBlur').classList.add('blur-md');
                document.querySelector('.body').innerHTML += `
                    <div class="popup w-[100%] h-[100%] bg-gray-700 opacity-[0.95] absolute">
                        <div class=" w-[100%] h-[100%] relative">
                            <div class=" min-w-[550px] max-w-[550px] min-h-[350px] max-h-[350px] border bg-white border-gray-200 rounded-lg absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] flex flex-col justify-center items-center p-6 gap-7">
                                <h1 class=" text-3xl font-semibold text-slate-900">You signed up successfully.</h1>
                                <i class="fa-solid fa-check text-emerald-400 text-[100px]"></i>
                                <button onclick="popUp()" class=" transition ease-in-out duration-500 hover:bg-indigo-400 bg-indigo-500 text-white px-8 py-2 rounded-lg text-xl"><i class="fa-solid fa-arrow-left"></i> Sign IN</button>
                            </div>
                        </div>
                    </div>
                `
                position = 'right';
                function popUp()
                {
                    if(position == 'right')
                    {
                        position = 'left';
                        document.querySelector('.change_pos').classList.remove('animate-[moveRight_500ms_ease-in-out_forwards]');
                        document.querySelector('.change_pos').classList.add('animate-[moveLeft_500ms_ease-in-out_forwards]');
                        document.querySelector('.change_pos').innerHTML = `
                            <div class=" -mt-[50px]">
                                <p>Welcome Back TO</p>
                                <p>ChatOnline</p>
                            </div>
                            <div>
                                <p>Login To Your Account with Email And Password.</p>
                                <br>
                                <p>If You Don't Have An Account Just</p>
                                <button onclick="ChangePosition()" class=" transition ease-in-out duration-500 hover:text-black mt-[100px] bg-white text-indigo-500 px-8 py-2 rounded-lg text-xl">Create One <i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        `;
                        document.querySelector('.popup').remove()
                        document.querySelector('.changeToBlur').classList.remove('blur-md')
                    }
                }
            </script>;
    <?php
        }
        unset($_SESSION['signup']);
    ?>
    <script src="scripts/login.js"></script>
</body>
</html>