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
<body>
    <div class=" grid grid-cols-5 h-screen max-h-screen">
        <div class=" col-start-1 col-end-3 grid grid-rows-10">
            <div class=" row-start-1 row-end-3 bg-indigo-500 rounded-b-lg flex gap-x-10 p-4">
                <div class=" text-white font-semibold">
                    <h1>Welcome </h1>
                    <h1><?php echo $_SESSION['uid'] ?></h1>
                </div>
                <a href="includes/logout.inc.php" class=" transition ease-in-out duration-500 hover:text-black mt-[100px] bg-white text-indigo-500 px-8 py-2 rounded-lg text-xl cursor-pointer"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
            <div class=" row-start-3 row-span-8 bg-slate-100">

            </div>
        </div>
        <div class=" col-start-3 col-span-3 grid grid-rows-10">
            <div class=" row-start-1 row-end-2 bg-indigo-400">

            </div>
            <div class=" row-start-2 row-span-8 bg-slate-100">

            </div>
            <div class=" row-start-10 row-span-1 bg-slate-200">

            </div>
        </div>
    </div>
</body>
</html>