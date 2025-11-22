@component('mail::message')
@php
    $settings = App\Models\settings::first();
@endphp

<style>
    .btn-green {
      display: inline-block;
      background-color: #28a745;
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      font-size: 16px;
      font-weight: bold;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn-green:hover {
      background-color: #218838;
    }

    .btn-green:active {
      background-color: #1e7e34;
    }
</style>

<center>
    <a href="{{ url('/forgot-password/reset') }}" class="btn-green">LINK RESET PASSWORD</a>
</center>

@endcomponent
