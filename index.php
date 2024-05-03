<?php 
    session_start();

    if (!isset($_SESSION['id']))
    {
        header('location: login');
    }

    include "classes/dbh.classes.php";
    include "classes/profileinfo.classes.php";
    include "classes/profileinfo-view.classes.php";
    include "classes/conversation.classes.php";
    include "classes/conversation-view.classes.php";

    $profileInfo = new ProfileInfoView();

    $imagePath = "./assets/uploads/Profile".$_SESSION['id']."*";
    $imageInfo = glob($imagePath);
    if (!empty($imageInfo)) 
    {
        $imageExt = explode(".", $imageInfo[0]);
        $imageActualExt = end($imageExt);
    }

    $conv = new ConversationView();

    $conversations = $conv->getUserConversation($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Online</title>
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
    <script>
        function scrollToBottom() {
            var chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to the bottom
        }

        window.addEventListener('load', scrollToBottom); // Scroll on page load
    </script>
</head>
<body class="body flex justify-center overflow-y-hidden items-center h-screen bg-white">
    <div class="changeToBlur w-[100%] mx-auto h-[100%] grid grid-cols-12 relative">
        <!-- Left Side -->
        <div class=" col-start-1 col-end-4 flex flex-col bg-white border-r border-gray-300 shadow-md overflow-hidden">
            <!-- Sticky Header -->
            <div class=" h-[120px] w-full bg-indigo-500 sticky top-0 grid grid-rows-2">
                <div class=" flex flex-row justify-between p-3">
                    <button onclick="menu()" class="rounded-full w-[40px] h-[40px] bg-[#1f1f1f]">
                        <div id="showMenu" class=" relative">
                            <div class=" rounded-full relative z-[10] w-[40px] h-[40px] outline-[1px] outline-[#1f1f1f] outline">
                                <img id="profileImg" src="<?php echo ( $profileInfo->fetchProfileImgStatus($_SESSION['id']) == 0 ) ? 'assets/Profile.jpg' : 'assets/uploads/Profile'.$_SESSION['id'].'.'.$imageActualExt.'?'.mt_rand() ?>" alt="Profile" class=" rounded-full relative z-[10] w-[40px] h-[40px] outline-[1px] outline-[#1f1f1f] outline">
                            </div>
                            <div class=" z-[-10] h-[35px] w-[160px] bg-[#1f1f1f] absolute top-[50%] left-0 translate-y-[-50%] rounded-full after:content-[''] after:bg-transparent after:block after:w-[15px] after:h-[35px] after:absolute after:top-[-34.7px] after:left-[26px] after:rounded-l-[7px] after:shadow-borderNL before:content-[''] before:bg-transparent before:block before:w-[15px] before:h-[30px] before:absolute before:top-[35px] before:left-[25px] before:rounded-l-lg before:shadow-borderNR">
                                <h1 class=" text-white text-[10px] font-semibold absolute top-[50%] translate-y-[-50%] left-[60%] translate-x-[-60%] ">
                                    <?php echo $_SESSION['uid'] ?>
                                </h1>
                            </div>
                        </div>
                    </button>
                    <a href="search" class="transition ease-in-out duration-500 rounded-full w-[40px] h-[40px] bg-white text-[#1f1f1f] hover:text-white hover:bg-[#1f1f1f] flex justify-center items-center">
                        <i class="fa-solid fa-user-plus"></i>
                    </a>
                </div>
                <div class=" flex justify-center items-center">
                    <input type="search" placeholder="Search" name="search" id="search" autocomplete="off" class=" w-[95%] h-[40px] mx-auto rounded-full p-2 outline-none">
                </div>
            </div>
        
            <!-- Conversation Area -->
            <div class="flex-grow p-4 overflow-y-auto" style="height: 75vh;">
                <!-- Conversation Exemple -->
                <div class="flex flex-col mb-4">

                <?php foreach ($conversations as $conversation) { 
                    $imagePath1 = "./assets/uploads/Profile".$conversation['withUser']."*";
                    $imageInfo1 = glob($imagePath1);
                    if (!empty($imageInfo1)) 
                    {
                        $imageExt1 = explode(".", $imageInfo1[0]);
                        $imageActualExt1 = end($imageExt1);
                    }    
                ?>
                    <a href="?c=<?php echo $conversation['id_c']; ?>" class=" h-[60px] w-full border-b border-gray-200 grid grid-cols-4 grid-rows-1 cursor-pointer">
                        <div class=" col-start-1 col-end-2 h-full flex justify-center items-center">
                            <img id="profileImg" src="<?php echo ( $profileInfo->fetchProfileImgStatus($conversation['withUser']) == 0 ) ? 'assets/Profile.jpg' : 'assets/uploads/Profile'.$conversation['withUser'].'.'.$imageActualExt1.'?'.mt_rand() ?>" alt="Profile" class=" rounded-full w-[50px] h-[50px] outline-[1px] outline-gray-50 outline">
                        </div>
                        <div class=" col-start-2 col-end-5 grid grid-rows-2 grid-cols-1">
                            <div class=" grid grid-cols-4 grid-rows-1">
                                <div class=" col-start-1 col-end-4 flex justify-start items-center font-semibold text-[20px]">
                                    <h1><?php echo $conversation['username'] ?></h1>
                                </div>
                                <div class=" flex justify-start items-center px-4 text-gray-400 col-start-4 col-end-5">
                                    <p>21:00</p>
                                </div>
                            </div>
                            <div class=" flex justify-start items-center text-gray-400">
                                ~ <p>This is a new mssage!</p>
                            </div>
                        </div>
                    </a>
                <?php 
                    } 
                ?>
                    
                </div>
            </div>
        </div>
        <!-- Right Side -->
    <?php if (isset($_GET['c'])) { ?>
        <?php
                $info = $conv->getSecondUserInformation($_SESSION['id'], $_GET['c']); // get the selected user information from the conversation
                $imagePath2 = "./assets/uploads/Profile".$info['withUser']."*";
                $imageInfo2 = glob($imagePath2);
                if (!empty($imageInfo2)) 
                {
                    $imageExt2 = explode(".", $imageInfo2[0]);
                    $imageActualExt2 = end($imageExt2);
                }
        ?>
            <div class=" col-start-4 col-end-13 flex flex-col bg-white shadow-md overflow-hidden">
            <!-- Sticky Header -->
            <div class="bg-indigo-500 h-16 flex items-center justify-between p-4 cursor-default">
                <div class=" cursor-pointer flex items-center">
                    <img id="profileImg" src="<?php echo ( $profileInfo->fetchProfileImgStatus($info['withUser']) == 0 ) ? 'assets/Profile.jpg' : 'assets/uploads/Profile'.$info['withUser'].'.'.$imageActualExt2.'?'.mt_rand() ?>" alt="Profile" class=" rounded-full w-[50px] h-[50px]">
                    <h1 class=" text-white ml-2 font-semibold text-xl"><?php echo $info['username'] ?></h1>
                </div>
                <a  href="includes/deleteconversation.inc.php?c=<?php echo $_GET['c'] ?>" class="group transition ease-in-out duration-500 hover:bg-red-500 w-10 h-10 rounded-full flex justify-center items-center cursor-pointer"><i class="fa-solid fa-trash transition ease-in-out duration-500 text-white group-hover:text-white"></i></a>
            </div>

            <!-- Message Area -->
            <div class="flex-grow p-4 overflow-y-auto" style="height: 75vh;" id="chat-messages">
                <!-- Example Chat Messages -->
                <div class="flex flex-col mb-4">

                    <div class="flex mb-4">
                        <div class="flex flex-col items-start bg-indigo-500 text-white p-3 rounded-lg max-w-xs">
                            <span>Hello! How can I help you today?</span>
                            <span class="text-xs text-gray-200 mt-1">21:00</span>
                        </div>
                    </div>

                    <div class="flex justify-end mb-4">
                        <div class="flex flex-col items-start bg-gray-200 text-black p-3 rounded-lg max-w-xs">
                            <span>Hi! I have a question about my order. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo minima harum aliquid porro aatione porro ea quis optio nihil quas obcaecati. Magni nostrum pariatur qui nobis provident, optio sapiente accusantium alias laboriosam inventore molestias aperiam aut. Magni quas voluptas perferendis voluptatum rerum, maxime laudantium quidem autem cumque obcaecati laborum sit aliquam unde esse soluta neque. Nihil debitis voluptas rem dolor?</span>
                            <span class="text-xs text-gray-500 mt-1">21:00</span>
                        </div>
                    </div>

                    <div class="flex justify-end mb-4">
                        <div class="flex flex-col items-start bg-gray-200 text-black p-3 rounded-lg max-w-xs">
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet porro debitis id similique, molestiae incidunt iste dignissimos eum maxime pariatur.</span>
                            <span class="text-xs text-gray-500 mt-1">21:00</span>
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="flex flex-col items-start bg-indigo-500 text-white p-3 rounded-lg max-w-xs">
                            <span>Hello! How can I help you today?</span>
                            <span class="text-xs text-gray-200 mt-1">21:00</span>
                        </div>
                    </div>

                    <div class="flex justify-end mb-4">
                        <div class="flex flex-col items-start bg-gray-200 text-black p-3 rounded-lg max-w-xs">
                            <span>Hi! I have a question about my order. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo minima harum aliquid porro aatione porro ea quis optio nihil quas obcaecati. Magni nostrum pariatur qui nobis provident, optio sapiente accusantium alias laboriosam inventore molestias aperiam aut. Magni quas voluptas perferendis voluptatum rerum, maxime laudantium quidem autem cumque obcaecati laborum sit aliquam unde esse soluta neque. Nihil debitis voluptas rem dolor?</span>
                            <span class="text-xs text-gray-500 mt-1">21:00</span>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Input Area -->
            <form>
                <div class="flex items-center p-4 bg-white border-t border-gray-300">
                    <input
                        type="text"
                        autocomplete="off"
                        placeholder="Type a message..."
                        class="flex-grow bg-gray-100 p-2 rounded-lg outline-none"
                        name="content"
                        id="content"
                    />
                    <button type="button" class="transition ease-in-out duration-500 ml-4 bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600" onclick="addMessage(content.value)">
                        Send
                    </button>
                </div>
            </form>
            </div>
    <?php
        } 
        else
        {
    ?>
        <div class=" col-start-4 col-end-13 flex flex-col justify-center items-center bg-white shadow-md overflow-hidden">
            <h1 class=" text-4xl">Welcome To</h1>
            <h1 class=" text-4xl text-indigo-500 font-bold mt-3 mb-3">Chat Online</h1>
            <a href="search" class=" text-xl text-white bg-indigo-500 w-fit rounded-lg p-2 font-bold mt-3">Start New Conversation</a>
        </div>
    <?php 
        }
    ?>
    </div>

    <script>
        function addMessage(content) 
        {
        var chatMessages = document.getElementById('chat-messages');

        // Create a new message element
        var newMessage = document.createElement('div');
        newMessage.className = 'flex justify-end mt-4';
        newMessage.innerHTML = `
            <div class="bg-gray-200 text-black p-3 rounded-lg max-w-xs">
                <span>${content}</span>
            </div>
        `;
        document.getElementById('content').value = '';

        // Append the new message to the chat container
        chatMessages.appendChild(newMessage);

        // Scroll to the bottom after adding the message
        scrollToBottom();
        }
    </script>

    <?php
        if (isset($_SESSION['login']))
        {
    ?>
            <script>
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
                }
            </script>
    <?php
        }
        unset($_SESSION['login']);
    ?>

    <script>
        menuToggle = 'off';

        function menu()
        {
            if (menuToggle == 'off')
            {
                menuToggle = 'on';
                document.getElementById('showMenu').innerHTML += `
                <div id="menu" class="  z-[0] h-[35px] w-[160px] bg-[#1f1f1f] absolute top-[50%] left-0 translate-y-[-50%] rounded-full after:content-[''] after:bg-transparent after:block after:w-[15px] after:h-[35px] after:absolute after:top-[-35px] after:left-[26px] after:rounded-l-[7px] after:shadow-borderNL before:content-[''] before:bg-transparent before:block before:w-[15px] before:h-[30px] before:absolute before:top-[35px] before:left-[25px] before:rounded-l-lg before:shadow-borderNR grid grid-cols-4 grid-rows-1 items-center justify-items-center">
                    <div class="group transition ease-in-out duration-500 w-6 h-6 rounded-full hover:bg-white col-start-2 col-end-3 cursor-pointer flex items-center justify-center" onclick="showProfile()">
                        <i class="fa-solid fa-user transition ease-in-out duration-500 z-[1000] text-white group-hover:text-[#1f1f1f]"></i>
                    </div>
                    <div class="group transition ease-in-out duration-500 w-6 h-6 rounded-full hover:bg-white col-start-3 col-end-4 cursor-pointer flex items-center justify-center">
                        <i class="fa-solid fa-gear transition ease-in-out duration-500 z-[1000] text-white group-hover:text-[#1f1f1f]"></i>
                    </div>
                    <a href="includes/logout.inc.php" class="group transition ease-in-out duration-500 w-6 h-6 rounded-full hover:bg-white col-start-4 col-end-5 cursor-pointer flex items-center justify-center">
                        <i class="fa-solid fa-right-from-bracket transition ease-in-out duration-500 z-[1000] text-white group-hover:text-[#1f1f1f]"></i>
                    </a>
                    
                </div>
                `;
            }
            else
            {
                menuToggle = 'off';
                document.getElementById('menu').remove();
            }
        }
    </script>

    <script>
        function showProfile()
        {
            document.querySelector('.changeToBlur').classList.add('blur-md');
            document.querySelector('.body').innerHTML += `
                <div class="popup w-[100%] h-[100%] bg-gray-700 opacity-[0.95] absolute">
                    <div class=" w-[55%] mx-auto h-[500px] my-auto bg-indigo-500 shadow-lg rounded-lg absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] cursor-default">
                        <div class="relative p-2 w-full h-[150px] bg-[#1f1f1f] rounded-t-lg after:content-[''] after:bg-transparent after:block after:w-[25px] after:h-[50px] after:absolute after:top-[150px] after:left-[12.038px] after:rounded-tr-full after:shadow-borderL before:content-[''] before:bg-transparent before:block before:w-[25px] before:h-[50px] before:absolute before:top-[150px] before:left-[193.238px] before:rounded-tl-full before:shadow-borderR">
                            <button onclick="popUp()" class=" px-4 absolute top-[20px] left-[15px]"><i class="fa-solid fa-arrow-left text-white text-2xl"></i></button>
                            <h1 class=" text-[50px] text-indigo-500 font-bold absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">Chat Online</h1>
                            <a href="profile" class="group transition ease-in-out duration-500 hover:text-black hover:bg-white absolute right-[20px] top-[50%] translate-y-[-50%] bg-transparent text-white px-8 py-2 border border-white rounded-md text-xl cursor-pointer"><pre>Edit  <i class="fa-regular fa-pen-to-square text-white transition ease-in-out duration-500 group-hover:text-black"></i></pre></a>
                        </div>
                        <div class="rounded-full w-[150px] h-[150px] absolute top-[70px] left-[40px] outline-8 bg-[#1f1f1f] outline outline-[#1f1f1f]">
                            <img id="profileImg" src="<?php echo ( $profileInfo->fetchProfileImgStatus($_SESSION['id']) == 0 ) ? 'assets/Profile.jpg' : 'assets/uploads/Profile'.$_SESSION['id'].'.'.$imageActualExt.'?'.mt_rand() ?>" alt="Profile" class=" rounded-full w-[150px] h-[150px] outline outline-[#1f1f1f]">
                        </div>
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