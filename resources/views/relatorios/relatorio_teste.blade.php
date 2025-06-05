<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório de Bens</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; /* Suporte a UTF-8 */ }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        /* Adicione mais estilos CSS aqui ou inline */
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Bens</h1>
        <p>Gerado em: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Patrimônio</th>
                <th>Marca</th>
                <th>Tipo de uso</th>
                <th>Estado</th>
                <th>Responsável</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bens as $bem)
                <tr>
                    <td>{{ $bem->patrimonio }}</td>
                    <td>{{ $bem->marca }}</td>
                    <td>{{ $bem->tipoUso }}</td>
                    <td>{{ $bem->estado }}</td>
                    <td>{{ $bem->user->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
