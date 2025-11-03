<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subasta Vendida</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="background: white; padding: 20px; border-radius: 10px;">
        <h2 style="color: #007bff;">📦 ¡Has vendido tu producto {{ $producto->nombre }}!</h2>
        <p>La subasta ha finalizado exitosamente.</p>

        <p><strong>Comprador:</strong> {{ $comprador->name }} ({{ $comprador->email }})</p>
        <p><strong>Precio final:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
        <p><strong>Fecha de finalización:</strong> {{ $producto->fechaFin->format('d/m/Y H:i') }}</p>

        <p>Por favor, ponte en contacto con el comprador para concretar el envío o entrega.</p>

        <br>
        <p>Gracias por usar nuestra plataforma de subastas.</p>
    </div>
</body>
</html>
