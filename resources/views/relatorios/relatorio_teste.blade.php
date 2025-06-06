<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Inventário Geral de Bens</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            color: #333;
        }

        @page {
            margin: 2.5cm 2cm 2cm 2cm;
            /* Aumentei a margem superior para o novo cabeçalho */
        }

        /* --- Estilos para o Novo Cabeçalho --- */
        .header {
            position: fixed;
            top: -2cm;
            /* Posição acima da margem da página */
            left: 0;
            right: 0;
            width: 100%;
            display: table;
            /* Usar display table para alinhamento vertical fácil */
            border: 1.5px solid #000;
            padding: 5px;
        }

        .header-row {
            display: table-row;
        }

        .logo-cell,

        .logo-cell .logo {
            max-width: 70px;
            /* Garante que a imagem não ultrapasse a largura da célula */
            max-height: 70px;
            /* Garante que a imagem não ultrapasse a altura */
            width: auto;
            height: auto;
        }

        .text-cell {
            display: table-cell;
            vertical-align: middle;
        }

        .logo-cell {
            width: 80px;
            /* Largura fixa para a célula do logo */
            padding: 5px;
        }

        .logo-cell svg {
            width: 70px;
            /* Tamanho do SVG */
            height: auto;
        }

        .text-cell {
            text-align: center;
        }

        .text-cell h1 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }

        .text-cell h2 {
            margin: 5px 0;
            font-size: 12px;
            font-weight: bold;
        }

        .text-cell p {
            margin: 0;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            position: fixed;
            bottom: -1.5cm;
            left: 0;
            right: 0;
            height: 1.5cm;
            font-size: 9px;
            color: #777;
        }

        .pagenum:after {
            content: "Página " counter(page);
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-row">
            <div class="text-cell">
                <h1>Universidade Federal do Maranhão</h1>
                <h2>Curso de Engenharia da Computação/CCET</h2>
                <p>Situação em {{ $dataGeracao }}</p>
            </div>
        </div>
    </div>

    <main>
        <h2 style="text-align: center; font-size: 16px; margin-bottom: 20px;">INVENTÁRIO GERAL DE BENS</h2>

        <div class="info" style="margin-bottom: 10px;">
            <p><strong>Número Total de Bens Registrados:</strong> {{ $bens->count() }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Patrimônio</th>
                    <th>Marca</th>
                    <th>Tipo de Uso</th>
                    <th>Estado</th>
                    <th>Localização</th>
                    <th>Responsável</th>
                    <th>Data de Registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bens as $bem)
                    <tr>
                        <td>{{ $bem->patrimonio ?? 'N/A' }}</td>
                        <td>{{ $bem->marca ?? 'N/A' }}</td>
                        <td>{{ $bem->tipoUso ?? 'N/A' }}</td>
                        <td>{{ $bem->estado ?? 'N/A' }}</td>
                        <td>{{ $bem->localizacao ?? 'N/A' }}</td>
                        <td>{{ $bem->user->name ?? 'N/A' }}</td>
                        <td>{{ $bem->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Nenhum bem encontrado no sistema.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p class="pagenum"> UFMA - </p>
        </div>
    </main>

</body>

</html>
