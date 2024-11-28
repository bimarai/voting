@extends('./templates/Header')
@extends('./templates/Navbar-Admin')


<div class="container mx-auto w-[100vw] h-[100vh] px-5 py-5 pt-[20%] md:pt-[10%] xl:pt-[5%]">
    <div class=" gap-20 items-center lg:flex justify-between">
        <div>
            <h1 class="text-6xl font-bold">Selamat Datang, <span class="text black-500"> Admin</span></h1>
            <h2 class="text-3xl">Anda berada pada dashboard admin</h2>
            <a href="/dashboard/hasil-voting">
               
            </a>
        </div>
        <div>
            <img class="w-[500px] " src="{{ asset('assets/adminhome.png') }}" alt="">
        </div>
    </div>


</div>



@extends('./templates/Footer')
