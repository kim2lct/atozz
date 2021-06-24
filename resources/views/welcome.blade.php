<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title','Salt Challenge')</title>
        <style>

            :root{
                --primary: #1facff;
                --secondary: #bfbfbf;
            }

            body{
                font-size: 14px;                
            }
            .flex{
                display: flex;
            }
            .block{
                display: block;
            }


            .justify-between{
                justify-content: space-between;
            }

            .f-column{

            }
            .container{
                max-width: 400px;
            }
            .mx-auto{
                margin: auto;
            }

            .b-1{
                border: 1px solid;
            }
            .shadow-1{
                box-shadow: -1px 1px 5px #50505042;
            }
            .p-20{
                padding: 20px;
            }

            .p-10{
                padding: 10px;
            }
            .center{
                text-align: center;
            }
            .bg-primary{
                background: var(--primary);
            }
            .bg-secondary{
                background: var(--secondary);
            }
            .d-form input:not([type=submit]) {
    width: 93%;
    padding: 12px;
    border: 2px solid #dadada;
    background:none;
    box-shadow:none;
    border-radius: 5px;
}

.d-form input[type=submit] {
    background: var(--primary);
    border: none;
    width: 100%;
    border-radius: 5px;
    padding: 12px;
    color: #fff;
    cursor: pointer;
}

.d-form select { 
    border: 2px solid #dadada;
    width: 100%;
    border-radius: 5px;
    padding: 12px;
    color: #777;
    cursor: pointer;
}

.d-form textarea {
    border: 2px solid #dadada;
    width: 94%;
    border-radius: 5px;
    padding: 10px;
}

.d-form ,.d-form-clean{    
    margin: 10px 0;
}

.d-form-clean input{
    border: none;
    font-weight: bold;
    font-size: 17px;
    text-align: right;
    color: #888;
}

a.register{
    color: var(--primary);
    text-decoration: none;
}
.mt-1{
    padding-top: 10px;
}

.error{
    color: red;
}

.success{
    color: green;
    background: #5daf5d;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}

.m-w-90{
    max-width: 90%;
}

.mb-5{
    margin-bottom: 50px;
}

.mb-1{
    margin-bottom: 10px;
}

ul{
    margin: 0;
}

ul li{
    margin-left: 25px;
    list-style: none;
}

ul li:first-child{
    position: relative;
}

ul li:first-child:after{
    content: '';
    width: 2px;
    height: 12px;
    position: absolute;
    top: 0;
    right: -15px;
    background: #000;
}

.aligns-center{
    align-items: center;
}

.font-12{
    font-size: 12px;
}

.text-primary{
    transition: 1s all;
    color: var(--primary);
}

.text-primary:hover{
    color: #6f6f6f;
}

.text-none{
    text-decoration: none;
}

.text-default{
    color: #888;
}

.my-10{
    margin: 10px 0;
}
.history{
    margin-top: 20px;
    max-height: 400px;
    overflow: scroll;
}
.history .show {
    border-top: 1px solid #cacaca;
    padding: 10px 0;
    border-bottom: 1px solid #cacaca;   
}

.history .show:first-child{
    border-bottom: none;
}
.none_strip{
    padding: 0;
}
.none_strip li{
    margin: 0;
    font-weight: bold;
    font-size: 14px;
}
.none_strip li:first-child:after{
    content: none;

}

a.pay {
    display: block;
    background: var(--primary);
    padding: 10px 8px;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight:600;
    transition: background .5s;
}

a.pay:hover {
    background: #003f65;
}

ul.pagination {
    display: flex;
    font-size: 17px;
    padding: 0;
    margin-top: 25px;
    justify-content: center;
}

ul.pagination li:first-child:after {
    content: none;
}

ul.pagination li a {
    color: #828282;
    font-weight: bold;
    text-decoration: none;
}

.status.failed{
    color: #ff9659;
}
.status.success{
    color: green;
    background: none;
}
.status.cancelled{
    color: red;
}
a.bagde {
    color: red;
    font-weight: 600;
    text-decoration: none;
    transition: color .5s ease;
}

a.bagde:hover{
    color: #ff5c5c;
}

.text-user{
    transition: color .5s;
    color: #656565;
}

.text-user:hover{
    color: var(--primary);
}
        </style>
    </head>
    <body class="antialiased">
        <div class="p-20">
        <div class="shadow-1 p-10 container mx-auto">
            <div class="mx-auto m-w-90 mb-5">
        @yield('content')
        
        </div>
        <footer class="center p-10">
            copyright &copy; 2021
        </footer>
        </div>
        </div>
    </body>
</html>
