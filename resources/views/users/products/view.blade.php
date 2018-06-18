@extends('users.layouts.nav_bar')
@section('title', $product->name)
@section('body-content')
<div class="row">
	<div class="col-md-7">
		@if($product->category->name == 'Accessory')
			<br><br><br><br>
		@endif
		<div class="slideshow-container">
			@foreach(explode(',', $product->image_names) as $product_image)
				<div class="mySlides fading">
					<img src="{{url('storage/'.$product->category->name.'/'.$product_image)}}" style="width:100%">
					{{-- <div class="text">{{$product_image}}</div> --}}
				</div>
			@endforeach

			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>
		</div>
		<br>
		@php
			$thumbnails = explode(',', $product->image_names);
			$n = count($thumbnails);
		@endphp
		<div style="text-align:center" class="thumbnails">
			@for($i=0; $i<$n; $i++)
				<img  class="thumbnail" src="{{url('storage/'.$product->category->name.'/'.$thumbnails[$i])}}" alt=""  onclick="currentSlide({{$i+1}})" width="100px" height="100px">
			@endfor
		</div>
	</div>
	<div class="col-md-5">
		<form action="" class=" product-info-container">
			<span class="product-category-name">{{$product->category->name}}</span>
			<p class="product-name">
				{{$product->name}}
			</p>
			<p class="product-price">
				<b>$ {{$product->price}}</b>
			</p>
			<p class="product-note-1">
				Made to order, typically delivers within 2 weeks. Free returns & exchanges - worldwide
			</p>
			<div class="hr hr-1">
				<hr>
			</div>
			<p class="product-description">
				{{$product->description}}
			</p>
			<p>
				<select name="size" class="form-control">
					<option value="" selected disabled>Select your shoe size</option>
					@foreach($sizes as $size)
					<option value="{{$size->size->id}}">{{$size->size->name}}</option>
					@endforeach
				</select>
				<br>
				<button class="btn btn-add-to-bag button form-control">
					ADD TO BAG
				</button>
			</p>
			<p class="product-note-2">
				Fits true to size. If between sizes, select the size down.
			</p>
			<div class="hr hr-2">
				<hr>
			</div>
		</form>
	</div>
</div>
<br><br><br>
<br><br><br>
@include('users.layouts.footer')
	<script>
		var slideIndex = 1;
		showSlides(slideIndex);

		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			var dots = document.getElementsByClassName("dot");
			if (n > slides.length) {slideIndex = 1}
			if (n < 1) {slideIndex = slides.length}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex-1].style.display = "block";
			dots[slideIndex-1].className += " active";
		}
	</script>
@stop