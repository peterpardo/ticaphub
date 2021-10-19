<x-guest-layout>		
	<section class="">
	  <div class="sliderAx h-auto">
		  <div id="slider-1" class="">
			<div class="py-10 md:py-32 lg:py-52 bg-cover bg-center h-full text-white px-10 w-full object-scale-down" style="background-image: url({{ url('assets/programflow.png') }})">
			<div class="">
			<p class="font-bold text-sm uppercase">TICAP 9.0</p>
			<p class="text-3xl font-bold">PROGRAM FLOW</p>
			<p class="text-2xl mb-10 leading-none">Simply click the button to view programs.</p>
			<a href="#" target="_blank" class="bg-red-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-red-700">View</a>
			</div>  
		</div> <!-- container -->
		  <br>
		  </div>
	
		  <div id="slider-2" class="">
			<div class="py-10 md:py-32 lg:py-52 bg-cover bg-center h-full text-white px-10 w-full object-contain md:object-scale-down" style="background-image: url(https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/84208363_10157998837678232_4444131587499491328_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeHmAILWaduyGUq7VyafWOnHRjfr1E3f8zNGN-vUTd_zM9E5ReZwF5VcWvYY1GqwFUJ490WM3e0k5gubvkM7dEs-&_nc_ohc=stfDLe2TSycAX-AMzNf&_nc_ht=scontent.fwnp1-1.fna&oh=4fc84044a5e3ae5d8f74c6a3e92d7929&oe=61907FC3)">
			<div class="">
				<p class="font-bold text-sm uppercase">FEU Institute of Technology</p>
				<p class="text-3xl font-bold ">College of Computer Studies</p>
				<p class="text-2xl mb-10 leading-none"></p>
				<a href="https://www.facebook.com/TICAPv5.0" target="_blank" class="bg-red-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-red-700">View more</a>
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
					<div class="h-72">
						<iframe class="w-full h-full object-cover object-center block rounded" src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fheintjievicente%2Fvideos%2F10158627770145853%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
					</div>
				</div>
				
				</div>
				<div class="flex flex-row items-center">
					<div class="flex flex-col">
						<h1 class="capitalize text-4xl font-extrabold mb-3">Technology Innovation in Capstone Project (TICAP)</h1>
						<p class="w-auto text-lg text-gray-500 text-justify">A research presentation and conference for project deployment, turn over and software packaging of capstone projects.</p>
						<div class="flex items-center my-6 cursor-pointer">
							<a href="{{ route('about-ticap') }}" class="bg-red-600 px-5 py-3 text-white rounded-lg w-2/4 text-center">View More</a>
						</div>
					</div>
				</div>
			</div>
	</main>
</x-guest-layout>
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