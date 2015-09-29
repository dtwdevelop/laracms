<p>Dear {{$name}}</p>

<p>Your Capsilite account created.</p>

<p><b>Email:</b> {{$user->email}}</p>

<p><b>Password:</b> {{$user->password}}</p>

<p>Login URL: <a href="{{URL::to('/admin')}}">{{URL::to('/admin')}}</a></p>
