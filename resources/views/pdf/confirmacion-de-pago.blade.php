<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 130px 50px 50px 50px;font-family: "Work Sans", sans-serif; font-optical-sizing: auto; font-weight: normal; font-style: normal; }
        header { background-color: #331344; position: fixed; top: -130px; left: -50px; right: -50px; height: 50px; text-align: left; padding: 30px 60px;}
        header img{ height:50px; width:auto; }
        p {margin: 3px 0;text-align:justify; line-height:150%; font-size:12pt;}
    </style>
</head>
<body>
    <header>
        <!-- <img src="{{ asset('images/logo-admin.png') }}"> -->
        <img src="https://stelarlink.com/images/logo-admin.png">
    </header>
    <main>

        <h1 style="color:#838383;font-weight: bold;">
            Confirmación de depósito
        </h1>

        <p style="font-weight: bold; font-size:16px; margin: 10px 0;">
            Datos del cliente
        </p>

        <p>
            Nombre completo: {{ $user_name }}
        </p>

        <p>
            ID de usuario: {{ $user_dni }}
        </p>

        <p>
            Contacto: {{ $user_phone }}
        </p>

        <p>
            Correo Electrónico: {{ $user_phone }}
        </p>

        <p style="text-align: right; font-weight: bold;">
            Fecha: {{ $date }}
        </p>

        <div style="background-color: #331344; margin-top: 10px; padding: 10px; color: #fff;font-weight: bold; font-size: 24px;">
            Detalles del Depósito:
        </div>

        <div style="background-color:#f1f1f1; padding: 10px; margin-bottom: 10px; min-height: 50px;">
            <p>
                Nombre: {{$plan_name}}
            </p>
            <p>
                Precio: $ {{$plan_price}}
            </p>
        </div>


        <div style="background-color: #331344; margin-top: 10px; padding: 10px; color: #fff;font-weight: bold; font-size: 24px;">
            Instruccines para usar el saldo:
        </div>

        <div style="background-color:#f1f1f1; padding: 10px; margin-bottom: 10px; min-height: 50px;">
            <p>
                Nombre: {{$plan_name}}
            </p>
            <p>
                Precio: $ {{$plan_price}}
            </p>
        </div>


        <div style="background-color: #331344; margin-top: 10px; padding: 10px; color: #fff;font-weight: bold; font-size: 24px;">
            Soporte:
        </div>

        <div style="background-color:#f1f1f1; padding: 10px; margin-bottom: 10px; min-height: 50px;">
            <p>
                Nombre: {{$plan_name}}
            </p>
            <p>
                Precio: $ {{$plan_price}}
            </p>
        </div>


        <div style="text-align: center;">

            <div style=" display: inline-block; padding: 60px; margin-right:30px; border-bottom: 1px solid #000;">
                Firma Cliente
            </div>

            <div style=" display: inline-block; padding:60px; margin-left:30px; border-bottom: 1px solid #000;">
                Firma Técnico
            </div>

        </div>


    </main>
</body>
</html>

