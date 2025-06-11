<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ficha do Bem - {{ $bem->patrimonio }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
        }

        @page {
            margin: 2.5cm 2cm;
        }

        .header,
        .footer {
            position: fixed;
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
        }

        .header {
            top: -2cm;
            border: 1.5px solid #000;
            padding: 5px;
        }

        .footer {
            bottom: -1.5cm;
            font-size: 9px;
            color: #777;
        }

        .header h1 {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
        }

        .header h2 {
            font-size: 12px;
            font-weight: normal;
            margin-top: 5px;
        }

        .header p {
            font-size: 10px;
            margin-top: 5px;
        }

        .section-title {
            background-color: #e9ecef;
            padding: 8px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 15px;
            text-align: center;
            border: 1px solid #ccc;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 6px;
            border: 1px solid #ddd;
        }

        .info-table .label {
            font-weight: bold;
            width: 20%;
            background-color: #f8f9fa;
        }

        .descricao-box {
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            margin-top: 5px;
        }

        .history-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .history-header {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .history-title {
            display: table-cell;
            font-size: 12px;
            font-weight: bold;
        }

        .history-date {
            display: table-cell;
            text-align: right;
            font-size: 10px;
            color: #555;
        }

        .history-body {
            font-size: 11px;
            border-top: 1px solid #eee;
            padding-top: 8px;
        }

        .history-body .detail {
            margin-bottom: 5px;
        }

        .history-footer {
            text-align: right;
            font-size: 9px;
            color: #777;
            margin-top: 10px;
        }

        .pagenum:before {
            content: "Página " counter(page);
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Universidade Federal do Maranhão</h1>
        <h2>Curso de Engenharia da Computação/CCET</h2>
        <p>Situação em {{ $dataGeracao }}</p>
    </div>

    <div class="footer">
        <p>UFMA - Ficha do Bem: {{ $bem->patrimonio }} - <span class="pagenum"></span></p>
    </div>

    <main>
        <div class="section-title">FICHA DO BEM</div>
        <table class="info-table">
            <tr>
                <td class="label">Patrimônio</td>
                <td>{{ $bem->patrimonio }}</td>
                <td class="label">Marca</td>
                <td>{{ $bem->marca }}</td>
            </tr>
            <tr>
                <td class="label">Estado</td>
                <td>{{ $bem->estado }}</td>
                <td class="label">Tipo de Uso</td>
                <td>{{ $bem->tipoUso }}</td>
            </tr>
            <tr>
                <td class="label">Responsável</td>
                <td>
                    <a href="mailto:{{ $bem->user->email }}">{{ $bem->user->name }}</a>
                    <br>
                    <span style="font-size: 9px; color: #555;">{{ $bem->user->email }}</span>
                </td>
                <td class="label">Localização</td>
                <td>{{ $bem->localizacao }}</td>
            </tr>
            <tr>
                <td class="label" colspan="4">Descrição</td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="descricao-box">
                        {!! nl2br(e($bem->descricao ?? 'Nenhuma descrição fornecida.')) !!}
                    </div>
                </td>
            </tr>
        </table>

        <div class="section-title">HISTÓRICO DE MOVIMENTAÇÕES</div>

        @forelse ($bem->historicos as $historico)
            <div class="history-item">
                <div class="history-header">
                    <span class="history-title">{{ $historico->tipo }}</span>
                    <span class="history-date">{{ $historico->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="history-body">
                    <div class="detail">
                        <strong>Localização:</strong>
                        @if ($historico->localizacao_anterior)
                            <span>{{ $historico->localizacao_anterior }} <strong>>></strong></span>
                        @endif
                        <span
                            style="background-color: #e2e8f0; padding: 2px 6px; border-radius: 10px;">{{ $historico->localizacao_atual }}</span>
                    </div>
                    <div class="detail">
                        <strong>Responsável:</strong>
                        @if ($historico->responsavelAnterior)
                            <span>{{ $historico->responsavelAnterior->name ?? 'N/A' }} <strong>>></strong></span>
                        @endif
                        <span
                            style="background-color: #e2e8f0; padding: 2px 6px; border-radius: 10px;">{{ $historico->responsavelAtual->name ?? 'Usuário Excluído' }}</span>
                    </div>
                </div>
                <div class="history-footer">
                    Registrado por: {{ $historico->registrador->name ?? 'Sistema' }}
                </div>
            </div>
        @empty
            <div
                style="text-align: center; margin-top: 20px; padding: 10px; background-color: #f8f9fa; border: 1px solid #ddd;">
                Nenhum histórico de movimentação para este bem.
            </div>
        @endforelse
    </main>
</body>

</html>
