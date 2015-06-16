<h1>Thank you!</h1>

<p>Date: {{ $data['date'] }}</p>

<p>Time: {{ date("g:i a",strtotime($data['time'])) }}</p>

<p>Capacity: {{ $data['capacity'] }} people</p>

<p>First name: {{ $data['fname'] }}</p>

<p>Last name : {{ $data['lname'] }}</p>

<p>Email: {{ $data['email'] }}</p>

<p>Phone: {{ $data['phone'] }}</p>