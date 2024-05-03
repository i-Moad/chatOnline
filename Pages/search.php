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

    $batch = isset($_GET['batch']) ? (int)$_GET['batch'] : 0;
    $recordsPerPage = 4;
    $offset = $batch * $recordsPerPage;

    $users = $profileInfo->fetchUsers($_SESSION['id'], $recordsPerPage, $offset);

    $next_batch = $batch + 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        ::-webkit-scrollbar {
            width: 5px;
            overflow-x: none;
        }
        ::-webkit-scrollbar-track{
            background-color: rgb(241 245 249 / var(--tw-bg-opacity));
            border-left: 1px solid rgb(229 231 235 / var(--tw-border-opacity));
        }
        ::-webkit-scrollbar-thumb{
            background-color: rgb(165 180 252 / var(--tw-bg-opacity));
        }
    </style>
</head>
<body>
    <div class="popup w-[100%] h-[100%] bg-gray-700 opacity-[0.95] absolute">
        <div class=" w-[100%] h-[100%] relative">
            <div class=" min-w-[550px] max-w-[550px] min-h-[380px] max-h-[380px] border bg-white border-gray-200 rounded-lg z-[1000] opacity-100 absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] flex flex-col justify-center items-center p-1">

                <!-- Go Back Button Area -->
                <div class="flex items-center p-4 min-h-[25px] max-h-[25px]">
                    <a href="home" class=" w-[50px] p-1 absolute top-[5px] left-[5px] font-semibold bg-transparent">
                        <i class="fa-solid fa-arrow-left text-black text-2xl"></i>
                    </a>
                </div>

                <!-- Users Area -->
                <div class="flex-grow p-4 overflow-y-auto min-h-[275px] max-h-[275px]">
                    <!-- Users Exemple -->
                    <div class="flex flex-col">

                    <?php 
                        foreach ($users as $user) { 
                            $imagePath1 = "../assets/uploads/Profile".$user['id']."*";
                            $imageInfo1 = glob($imagePath1);
                            if (!empty($imageInfo1)) 
                            {
                                $imageExt1 = explode(".", $imageInfo1[0]);
                                $imageActualExt1 = end($imageExt1);
                            }
                    ?>
                        <div class=" h-[60px] w-[100%] border-b border-gray-200 grid grid-cols-4 grid-rows-1">
                            <div class=" col-start-1 col-end-2 h-full flex justify-center items-center">
                                <img id="profileImg" src="<?php echo ( $profileInfo->fetchProfileImgStatus($user['id']) == 0 ) ? 'assets/Profile.jpg' : 'assets/uploads/Profile'.$user['id'].'.'.$imageActualExt1.'?'.mt_rand() ?>" alt="Profile" class=" rounded-full w-[50px] h-[50px] outline-[1px] outline-gray-50 outline">
                            </div>
                            <div class=" col-start-2 col-end-5 grid grid-cols-4 grid-rows-1">
                                <div class=" col-start-1 col-end-4 grid grid-rows-2 grid-cols-1">
                                    <div class=" col-start-1 col-end-4 flex justify-start items-center font-semibold text-[20px]">
                                        <h1><?php echo $user['username'] ?></h1>
                                    </div>
                                    <div class=" justify-start items-center text-gray-400 overflow-hidden">
                                        <p class=" col-start-1 col-end-4"><?php echo $user['about'] ?></p>
                                    </div>
                                </div>
                                <form action="includes/conversation.inc.php" method="post" class=" col-start-4 col-end-5 flex justify-start items-center px-4 text-gray-400">
                                    <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                                    <button type="submit" class="transition ease-in-out duration-500 rounded-full w-[40px] h-[40px] bg-white text-[#1f1f1f] hover:text-white hover:bg-[#1f1f1f] flex justify-center items-center">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                </div>

                <!-- Button Area -->
                <div class="flex items-center p-4 min-h-[50px] max-h-[50px]">
                    <a href="?batch=<?php echo $next_batch ?>" class="transition ease-in-out duration-500 ml-4 bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600">
                        Show More
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>