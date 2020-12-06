<script>
    function onClick(){
        document.getElementById('dark-overlay').style.display = "none";
    }
</script>

<div id="dark-overlay" class="dark-overlay">
    <div class="dialog">
        <div class="dialog-text">
            <h4 class="font-weight">Parece que ocorreu um erro...</h4>
            <div>
                <p><span class="font-weight">Erro: </span><span>Campos por preencher.</span></p>
                <p>Por favor, preencha todos os campos.</p>
            </div>
        </div>

        <div class="dialog-btn-container">

            <button class="dialog-btn confirm modal-error-btn" onclick="onClick()">OK</button>

        </div>

    </div>
</div>
