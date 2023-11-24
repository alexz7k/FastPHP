<!DOCTYPE html>
<html>
<head>
    <title>Calculadora PHP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Calculadora PHP</div>
                    <div class="card-body">
                        <!-- Formulário para entrada de dados -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <!-- Campo para o número de imóveis -->
                            <div class="mb-3">
                                <label for="num_imoveis" class="form-label">Número de Imóveis</label>
                                <input type="text" class="form-control" id="num_imoveis" name="num_imoveis">
                            </div>

                            <!-- Div para os campos dos valores dos imóveis -->
                            <div id="valores_imoveis">
                                <!-- Campos para os valores dos imóveis serão gerados aqui -->
                            </div>

                            <!-- Seleção da operação -->
                            <div class="mb-3">
                                <label for="operator" class="form-label">Operação</label>
                                <select class="form-select" id="operator" name="operator">
                                    <option value="add">Adição</option>
                                    <option value="subtract">Subtração</option>
                                    <option value="multiply">Multiplicação</option>
                                    <option value="divide">Divisão</option>
                                </select>
                            </div>

                            <!-- Botão para enviar o formulário -->
                            <button type="submit" class="btn btn-primary">Calcular</button>
                        </form>

                        <!-- Script para gerar campos de valores dinamicamente -->
                        <script>
                            document.getElementById('num_imoveis').addEventListener('input', function () {
                                var numImoveis = parseInt(this.value);
                                var container = document.getElementById('valores_imoveis');
                                container.innerHTML = '';

                                for (var i = 1; i <= numImoveis; i++) {
                                    var input = document.createElement('input');
                                    input.type = 'text';
                                    input.className = 'form-control mb-3';
                                    input.name = 'valores_imovel[]';
                                    input.placeholder = 'Valor do Imóvel ' + i;
                                    input.required = true;
                                    container.appendChild(input);
                                }
                            });
                        </script>

                        <?php
                            // Processamento dos dados do formulário
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $numImoveis = $_POST['num_imoveis'];
                                $values = $_POST['valores_imovel'];
                                $operator = $_POST['operator'];
                                $result = 0;

                                // Verifica se os campos estão preenchidos
                                if (!empty($values) && is_array($values)) {
                                    foreach ($values as $value) {
                                        if (is_numeric($value)) {
                                            // Realiza a operação selecionada para cada valor dos imóveis
                                            switch ($operator) {
                                                case 'add':
                                                    $result += $value;
                                                    break;
                                                case 'subtract':
                                                    $result -= $value;
                                                    break;
                                                case 'multiply':
                                                    $result *= $value;
                                                    break;
                                                case 'divide':
                                                    if ($value != 0) {
                                                        $result /= $value;
                                                    } else {
                                                        $result = 'Divisão por zero não é possível';
                                                    }
                                                    break;
                                                default:
                                                    $result = 'Selecione uma operação';
                                            }
                                        } else {
                                            $result = 'Insira apenas números nos valores dos imóveis';
                                            break;
                                        }
                                    }
                                } else {
                                    $result = 'Preencha os valores dos imóveis';
                                }

                                // Exibe o resultado
                                echo '<h5>Resultado: ' . $result . '</h5>';
                            }
                        ?>
                    </div>
                    <a href="painel.php">Voltar</a><br> 
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

