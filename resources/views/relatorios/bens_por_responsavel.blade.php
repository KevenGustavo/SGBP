<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Inventário por Responsável - {{ $responsavel->name }}</title>
    {{-- O CSS é exatamente o mesmo do relatório anterior, então pode copiar e colar --}}
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 10px; color: #333; }
        @page { margin: 2.5cm 2cm; }
        .header, .footer { position: fixed; left: 0; right: 0; width: 100%; text-align: center; }
        .header { top: -2cm; border: 1.5px solid #000; padding: 5px; }
        .footer { bottom: -1.5cm; font-size: 9px; color: #777; }
        .header h1, .header h2, .header p { margin: 0; }
        .header h1 { font-size: 14px; font-weight: bold; }
        .header h2 { font-size: 12px; font-weight: normal; margin-top: 5px;}
        .header p { font-size: 10px; margin-top: 5px;}
        .info-box { border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; font-size: 11px; }
        .info-box p { margin: 0 0 5px 0; }
        .group-title {
            background-color: #e9ecef;
            padding: 8px;
            font-weight: bold;
            font-size: 12px;
            margin-top: 20px;
            border: 1px solid #ccc;
            border-bottom: none;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: left; word-wrap: break-word; }
        th { background-color: #f8f9fa; font-weight: bold; }
        .pagenum:before { content: "Página " counter(page); }
    </style>
</head>
<body>
    <div class="header">
        <h1>Universidade Federal do Maranhão</h1>
        <h2>Curso de Engenharia da Computação/CCET</h2>
        <p>Situação em {{ $dataGeracao }}</p>
    </div>

    <div class="footer">
        <p>UFMA - <span class="pagenum"></span></p>
    </div>

    <main>
        <h2 style="text-align: center; font-size: 16px; margin-bottom: 20px;">INVENTÁRIO DE BENS POR RESPONSÁVEL</h2>

        <div class="info-box">
            <p><strong>Responsável:</strong> {{ $responsavel->name }}</p>
            <p><strong>E-mail:</strong> {{ $responsavel->email }}</p>
            <hr style="border-top: 1px dashed #ccc; margin: 5px 0;">
            <p><strong>Número Total de Bens Sob Responsabilidade:</strong> {{ $totalBensDoResponsavel }}</p>
            @if($contagemPorEstado->isNotEmpty())
                <p><strong>Resumo por Estado:</strong></p>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($contagemPorEstado as $estado => $total)
                        <li>{{ $estado }}: <strong>{{ $total }}</strong> bem(ns)</li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- O loop principal permanece o mesmo --}}
        @forelse ($bensAgrupados as $estado => $bensDoEstado)
            <div class="group-container" style="page-break-inside: avoid;">
                <div class="group-title">
                    Estado: {{ $estado }} (Total de Itens: {{ count($bensDoEstado) }})
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Patrimônio</th>
                            <th>Marca</th>
                            <th>Tipo de Uso</th>
                            <th>Localização</th>
                            <th>Data Cadastro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bensDoEstado as $bem)
                            <tr>
                                <td>{{ $bem->patrimonio ?? 'N/A' }}</td>
                                <td>{{ $bem->marca ?? 'N/A' }}</td>
                                <td>{{ $bem->tipoUso ?? 'N/A' }}</td>
                                <td>{{ $bem->localizacao ?? 'N/A' }}</td>
                                <td>{{ $bem->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div style="text-align: center; margin-top: 30px;">
                <p>Nenhum bem encontrado sob a responsabilidade de {{ $responsavel->name }}.</p>
            </div>
        @endforelse
    </main>
</body>
</html>
