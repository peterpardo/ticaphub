<x-guest-layout>
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
					$("#sButton1").removeClass("bg-red-800");
					$("#sButton2").addClass("bg-red-800");
				cont=1;
				
				break;
				}
				case 1:
				{
				
					$("#slider-2").fadeOut(400);
					$("#slider-1").delay(400).fadeIn(400);
					$("#sButton2").removeClass("bg-red-800");
					$("#sButton1").addClass("bg-red-800");
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
			$("#sButton2").removeClass("bg-red-800");
			$("#sButton1").addClass("bg-red-800");
			reinitLoop(4000);
			cont=0
			}

			function sliderButton2(){
			$("#slider-1").fadeOut(400);
			$("#slider-2").delay(400).fadeIn(400);
			$("#sButton1").removeClass("bg-red-800");
			$("#sButton2").addClass("bg-red-800");
			reinitLoop(4000);
			cont=1
			}
		
			$(window).ready(function(){
				$("#slider-2").hide();
				$("#sButton1").addClass("bg-red-800");
				loopSlider();
			});
		  </script>
		</head>

		
		<section class="">
		  <div class="sliderAx h-auto">
			  <div id="slider-1" class="container mx-auto">
				<div class="bg-cover bg-center h-72 text-white py-24 px-10 w-full object-fill" style="background-image: url(https://scontent.fcrk1-3.fna.fbcdn.net/v/t1.6435-9/160950630_369557754442105_837620697662940079_n.png?_nc_cat=100&ccb=1-5&_nc_sid=e3f864&_nc_eui2=AeFkNjiZb7gzWI43J5qjeDLBz1rYixdMUKTPWtiLF0xQpET6WYGFUhbWzGRa4rcH_Ycd0GvZv_d2IADnXG9gVOhR&_nc_ohc=4LS-dDQLDD0AX8G9Jpv&_nc_ht=scontent.fcrk1-3.fna&oh=a6a14ea8b02271216e41cc610a3c4a9b&oe=6177C967)">
			    <div class="md:w-1/2">
				<p class="font-bold text-sm uppercase">TICaP 8.0</p>
				<p class="text-3xl font-bold">TICAP HUB</p>
				<p class="text-2xl mb-10 leading-none">An Event Management system for FEU Tech's (TICAP)</p>
				<a href="#" class="bg-red-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">View more</a>
				</div>  
			</div> <!-- container -->
			  <br>
			  </div>
		
			  <div id="slider-2" class="container mx-auto">
				<div class="bg-cover bg-center h-72 text-white py-24 px-10 w-full object-fill" style="background-image: url(https://images.unsplash.com/photo-1544144433-d50aff500b91?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80)">
			    <div class="md:w-1/2">
					<p class="font-bold text-sm uppercase">Ipsum</p>
					<p class="text-3xl font-bold">Hello Peter</p>
					<p class="text-2xl mb-10 leading-none">Lorem ipsum dolor sit amet.</p>
					<a href="#" class="bg-red-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">View more</a>
				</div>
				 
			</div> <!-- container -->
			  <br>
			  </div>
			</div>
		 <div class="flex justify-around w-12 mx-auto">
				<button id="sButton1" onclick="sliderButton1()" class="bg-red-400 rounded-full w-4 pb-2"></button>
			<button id="sButton2" onclick="sliderButton2() " class="bg-red-400 rounded-full w-4 p-2"></button>
		  </div>
		</section>
		<main class="container mx-auto flex flex-row items-center p-5 w-auto h-auto justify-evenly">
			<div class="grid grid-col md:grid-cols-2">
				<div class="flex flex-row md:justify-start justify-center">
					<div class="flex flex-col w-full md:w-3/4 object-cover h-4/5 justify-items-start border rounded-lg overflow-hidden"
						style="min-heigth:320px">
						<img class="w-full h-full object-cover content-center" src="https://i.ibb.co/KNxJKVh/206196728-119295477048972-4615482157495303098-n.png" alt="206196728-119295477048972-4615482157495303098-n" border="0">
					</div>
					
					</div>
					<div class="flex flex-row items-center">
						<div class="flex flex-col">
							<h1 class="capitalize text-4xl font-extrabold mb-3">Technology Innovation in Capstone Project (TICAP)</h1>
							<p class="w-auto text-lg text-gray-500 text-justify">A research presentation and conference for project deployment, turn over and software packaging of capstone projects.</p>
							<div class="flex items-center my-6 cursor-pointer">
								<div class="bg-red-600 px-5 py-3 text-white rounded-lg w-2/4 text-center">Contact Us</div>
							</div>
						</div>
					</div>
				</div>
		</main>

</x-guest-layout>