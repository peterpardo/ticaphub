<x-guest-layout>
    <nav class="relative px-4 py-4 flex justify-between items-center bg-white">
		<a class="text-3xl font-bold leading-none" href="#">
			TICaP Hub
		</a>
		<div class="lg:hidden">
			<button class="navbar-burger flex items-center text-blue-600 p-3">
				<svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<title>Mobile menu</title>
					<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
				</svg>
			</button>
		</div>
		<ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:items-center lg:w-auto lg:space-x-6">
            <li><a class="text-sm text-blue-600 font-bold" href="#">Home</a></li>
			<li class="text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
				</svg>
			</li>
            <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">About Us</a></li>
			<li class="text-gray-300">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
				</svg>
			</li>
			<li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Specializations</a></li>
			<li class="text-gray-300">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
				</svg>
			</li>
			<li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Contact</a></li>
		</ul>
        @auth
            <a class="hidden lg:inline-block py-2 px-6 bg-blue-500 hover:bg-blue-600 text-sm text-white font-bold rounded-xl transition duration-200" href="{{ route('dashboard') }}">Go to Dashboard</a>
        @else
		    <a class="hidden lg:inline-block py-2 px-6 bg-blue-500 hover:bg-blue-600 text-sm text-white font-bold rounded-xl transition duration-200" href="{{ route('login') }}">Sign in</a>
        @endauth
	</nav>
    {{-- BURGER MENU --}}
	<div class="navbar-menu relative z-50 hidden">
		<div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
		<nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
			<div class="flex items-center mb-8">
				<a class="mr-auto text-3xl font-bold leading-none" href="#">
					TICaP Hub
				</a>
				<button class="navbar-close">
					<svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</div>
			<div>
				<ul>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Home</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">About Us</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Specializations</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Contact</a>
					</li>
				</ul>
			</div>
			<div class="mt-auto">
				<div class="pt-6">
					<a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl" href="{{ route('login') }}">Sign In</a>
				</div>
				<p class="my-4 text-xs text-center text-gray-400">
					<span>Copyright © 2021</span>
				</p>
			</div>
		</nav>
	</div>
	
	<head>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
		  <script>
			var cont=0;
		function loopSlider(){
		  var x= setInterval(function(){
				switch(cont)
				{
				case 0:{
					$("#slider-1").fadeOut(400);
					$("#slider-2").delay(400).fadeIn(400);
					$("#sButton1").removeClass("bg-blue-800");
					$("#sButton2").addClass("bg-blue-800");
				cont=1;
				
				break;
				}
				case 1:
				{
				
					$("#slider-2").fadeOut(400);
					$("#slider-1").delay(400).fadeIn(400);
					$("#sButton2").removeClass("bg-blue-800");
					$("#sButton1").addClass("bg-blue-800");
				   
				cont=0;
				
				break;
				}

				}},8000);
		
		}
		
		function reinitLoop(time){
		clearInterval(xx);
		setTimeout(loopSlider(),time);
		}

		function sliderButton1(){
		
			$("#slider-2").fadeOut(400);
			$("#slider-1").delay(400).fadeIn(400);
			$("#sButton2").removeClass("bg-blue-800");
			$("#sButton1").addClass("bg-blue-800");
			reinitLoop(4000);
			cont=0
			}

			function sliderButton2(){
			$("#slider-1").fadeOut(400);
			$("#slider-2").delay(400).fadeIn(400);
			$("#sButton1").removeClass("bg-blue-800");
			$("#sButton2").addClass("bg-blue-800");
			reinitLoop(4000);
			cont=1
			}
		
			$(window).ready(function(){
				$("#slider-2").hide();
				$("#sButton1").addClass("bg-blue-800");
				loopSlider();
			});

		  </script>
		</head>
		
		<section class="">
		  <div class="sliderAx h-auto">
			  <div id="slider-1" class="container mx-auto">
				<div class="bg-cover bg-center h-5/6 text-white py-24 px-10 object-fill" style="background-image: url(https://images.unsplash.com/photo-1544427920-c49ccfb85579?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1422&q=80)">
			   <div class="md:w-1/2">
				<p class="font-bold text-sm uppercase">Lorem</p>
				<p class="text-3xl font-bold">Hello Migs</p>
				<p class="text-2xl mb-10 leading-none">Lorem ipsum dolor sit amet.</p>
				<a href="#" class="bg-blue-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a>
				</div>  
			</div> <!-- container -->
			  <br>
			  </div>
		
			  <div id="slider-2" class="container mx-auto">
				<div class="bg-cover bg-top h-5/6 text-white py-24 px-10 object-fill" style="background-image: url(https://images.unsplash.com/photo-1544144433-d50aff500b91?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80)">
			   
		  <p class="font-bold text-sm uppercase">Ipsum</p>
				<p class="text-3xl font-bold">Hello Peter</p>
				<p class="text-2xl mb-10 leading-none">Lorem ipsum dolor sit amet.</p>
				<a href="#" class="bg-blue-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a>
				 
			</div> <!-- container -->
			  <br>
			  </div>
			</div>
		 <div  class="flex justify-between w-12 mx-auto pb-2">
				<button id="sButton1" onclick="sliderButton1()" class="bg-blue-400 rounded-full w-4 pb-2 " ></button>
			<button id="sButton2" onclick="sliderButton2() " class="bg-blue-400 rounded-full w-4 p-2"></button>
		  </div>
		</section>
		<main class="flex items-center p-5 w-auto h-auto my-5">
			<div class="pt-16 grid grid-cols-2 gap-8">
				<div class="flex flex-col justify-start">
					<div class="flex flex-col w-full object-cover h-4/6 justify-items-start border rounded-lg overflow-hidden"
						style="min-heigth:320px">
						<img class="w-full h-full object-cover" src="https://i.ibb.co/KNxJKVh/206196728-119295477048972-4615482157495303098-n.png" alt="206196728-119295477048972-4615482157495303098-n" border="0">
					</div>
					
					</div>
					<div class="flex flex-col">
						<div class="flex flex-col gap-4">
							<h1 class="capitalize text-4xl font-extrabold">TICAP 7.0</h1>
							<p class="text-lg text-gray-500	">Lorem ipsum dolor sit amet consectetur adipisicing elit.
								Voluptatibus voluptatum nisi maxime obcaecati impedit? Ratione error eum qui quidem? Veniam
								accusamus ea repudiandae itaque, explicabo quidem perspiciatis. Culpa, asperiores deserunt.</p>
							<div class="flex items-center gap-4 my-6 cursor-pointer ">
								<div class="bg-blue-600 px-5 py-3 text-white rounded-lg w-2/4 text-center">View more</div>
							</div>
						</div>
					</div>
				</div>
		</main>
</x-guest-layout>