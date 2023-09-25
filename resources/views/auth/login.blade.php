<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LoginPage</title>
    @vite('resources/css/app.css')
  </head>
  <body class="p-0">
    
    <div class="min-h-screen flex justify-center items-center" style= "background-image: linear-gradient(115deg, #00294A,#0F0E12);">
      <div class="container mx-auto">
        <div class=" flex flex-col justify-center lg:flex-row w-10/12 lg:8/12 bg-white rounded-xl mx-auto shadow-lg overflow-hidden">
          <div class="w-full lg:w-1/2 flex flex-col items-begin justify-center p-12 bg-no-repeat bg-cover bg-center" style="background-image: url('images/venue.jpg');">
            {{-- <h1 class="text-white text-5xl mb-1 font-bold">Welcome</h1> --}}
            {{-- <div>
              <p class="text-white text-2xl font-semibold">Book a venue with us.</p>
            </div> --}}
          </div>

           <!-- //Login -->
           <div class="w-full lg:1/2 py-16 px-12">
            <h2 class="text-3xl mb-4">Login</h2>
            <p class="mb-4">Sign in to your account</p>
            <form action="{{route('login-user')}}" class="login_form" method="post" name="form">
              @if(Session::has('success'))
              <div role="alert" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">{{Session::get('success')}}</div>
              @endif
              @if(Session::has('fail'))
              <div role="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{Session::get('fail')}}</div>
              @endif
              @csrf
              <div class="mt-5">
                <input type="text" placeholder="Email" name="email" class="border border-gray-400 py-1 px-2 w-full rounded-lg" value="{{old('email')}}">
                <span class=" text-red-600">@error('email') {{$message}} @enderror</span>
              </div>
      

              <div class="mt-5"> 
                <input type="password" placeholder="Password" name="password" class="border border-gray-400 py-1 px-2 w-full rounded-lg">
                <span class=" text-red-600">@error('password') {{$message}} @enderror</span>
              </div>
              

              <div class="flex mt-2 underline text-blue-900 justify-end items-center">
                <a href="#">Forgot Password?</a>
              </div>
              
              <div class="flex mt-5 align-middle justify-center">
                <button type="submit" class="w-1/2 bg-blue-900 py-3 text-center text-white rounded-lg hover:bg-black hover:text-white">Login
                </button>
              </div>

              {{-- <div class="flex mt-5 align-middle justify-center">
                <button class="w-1/2 border border-gray-300 text-md p-2 rounded-lg mb-6 hover:bg-black hover:text-white">
                <img src="images/google.png" alt="img" class="w-6 h-6 inline mr-2">
                Login with Google
              </button>
              </div> --}}

              <div class="w-full flex items-center justify-center mt-5">
                <span>
                  Don't have an account? <a  href="registration" class="text-blue-900 font-semibold underline">Sign Up</a>
                  </span>
              </div>
            </div>

            </form>

        </div>
        
    </div>
  
  </div>
</div>
<script type="module" src="/main.js">
</script>
</body>
</html>
