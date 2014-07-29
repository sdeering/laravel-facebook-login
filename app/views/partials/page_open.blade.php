<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel PHP Framework</title>

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  <style>
    @import url(//fonts.googleapis.com/css?family=Lato:700);

    *, *:before, *:after {
      -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
    }

    body {
      /*margin:25px;*/
      font-family:'Lato', sans-serif;
      color: #999;
      padding: 0;
      margin: 0;
    }

    header img.logo {
      height: 40px;
      position: absolute;
      left: 5px;
      top: 5px;
    }

    footer {
      width: 100%;
      border-top: 1px solid #E6E6E6;
      padding: 10px 0;
      margin-top: 25px;
      text-align: center;
      font-size: 12px;
      position: fixed;
      bottom: 0;
      background-color: #FFF;
    }

    #main {
      padding-bottom: 50px;
    }

    a, a:visited {
      text-decoration:none;
    }

    h1 {
      font-size: 38px;
      /*margin: 0;*/
      /*padding-left: 10px;*/
      float: left;
      display: inline-block;
    }

    ul {
      text-align: left;
    }

    table {
      font-size: 14px;
    }

    tr, td {
      text-align: left;
    }

    td {
      padding-right: 15px;
    }

    .navbar-nav {
      margin-left: 15px;
    }

    .navbar {
      border-radius: 0;
    }

  </style>
</head>
<body>

@include('partials.header')
