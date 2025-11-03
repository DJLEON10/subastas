<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subasta Ganada</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="background: white; padding: 20px; border-radius: 10px;">
        <h2 style="color: #28a745;">🎉 ¡Felicidades {{ $comprador->name }}!</h2>
        <p>Has ganado la subasta del producto:</p>
        <h3>{{ $producto->nombre }}</h3>
        <p><strong>Precio final:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
        <p><strong>Fecha de finalización:</strong> {{ $producto->fechaFin->format('d/m/Y H:i') }}</p>

        <p>Pronto el vendedor se pondrá en contacto contigo para coordinar el pago y entrega.</p>
        <br>
        <p>Gracias por participar en nuestra plataforma de subastas.</p>
    </div>
</body>
</html>
