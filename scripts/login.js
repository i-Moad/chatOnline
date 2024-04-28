position = 'right'
function ChangePosition()
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
    }
    else
    {
        position = 'right'
        document.querySelector('.change_pos').classList.remove('animate-[moveLeft_500ms_ease-in-out_forwards]');
        document.querySelector('.change_pos').classList.add('animate-[moveRight_500ms_ease-in-out_forwards]');
        document.querySelector('.change_pos').innerHTML = `
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
        `;
    }
}