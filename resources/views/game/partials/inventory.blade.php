<div class="inventory-container">

    <button class="inventory-button" id="inventory-button">
        <i class="fas fa-shopping-bag"></i>
    </button>

    <div class="inventory-panel" id="inventory-panel">

        <div class="inventory-header">
            <h3>INVENTARIO</h3>
            <button id="close-inventory">×</button>
        </div>
        <div class="inventory-items">
            @if(session('inventory.' . $case->id . '.fiber'))
                <div class="inventory-item">
                    <i class="fas fa-hand-sparkles"></i>
                    <span>Fibra de guante</span>
                </div>
            @endif

            @if(session('inventory.' . $case->id . '.letter'))
                <div class="inventory-item" id="inventory-letter">
                    <i class="fas fa-envelope"></i>
                    <span>Carta</span>
                </div>
            @endif
            @if(session('inventory.' . $case->id . '.photograph'))
                <div class="inventory-item" id="inventory-photograph"> 
                    <i class="fas fa-image"></i> 
                    <span>Fotografía del sospechoso</span>
                </div>
            @endif

            @if(!session('inventory.' . $case->id . '.fiber') && !session('inventory.' . $case->id . '.letter') && !session('inventory.' . $case->id . '.photograph'))
                <p class="empty-inventory">
                    El inventario está vacío.
                </p>
            @endif

        </div>
        <div class="inventory-letter-zoom" id="inventory-letter-zoom">
            <img src="{{ asset('images/carta.png') }}">
        </div>
        <div class="inventory-photo-zoom" id="inventory-photo-zoom">
            <img src="{{ asset('images/foto-sospechoso.png') }}">
        </div>
    </div>
</div>

<style>

    .inventory-container {
        position: fixed;
        bottom: 25px;
        left: 25px;
        z-index: 100;
    }

    .inventory-button {
        width: 55px;
        height: 55px;
        border: 1px solid #E3D3AC;
        border-radius: 50%;
        background: rgba(20, 20, 20, 0.9);
        color: #E3D3AC;
        font-size: 24px;
        cursor: pointer;
    }

    .inventory-panel {
        display: none;
        position: fixed;
        bottom: 90px;
        left: 25px;
        width: 320px;
        background: rgba(20, 15, 10, 0.97);
        color: #E3D3AC;
        border: 1px solid #E3D3AC;
        border-radius: 10px;
        padding: 20px;
    }

    .inventory-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #E3D3AC;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .inventory-header h3 {
        margin: 0;
        font-size: 20px;
    }

    .inventory-header button {
        background: none;
        border: none;
        color: #E3D3AC;
        font-size: 25px;
        cursor: pointer;
    }

    .inventory-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        cursor: pointer;
    }

    .inventory-item i {
        width: 25px;
        text-align: center;
    }

    .empty-inventory {
        text-align: center;
        margin: 10px 0;
    }

    .inventory-letter-zoom {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        align-items: center;
        justify-content: center;
        z-index: 200;
    }

    .inventory-letter-zoom img {
        max-width: 80%;
        max-height: 80%;
        border: 3px solid #E3D3AC;
        border-radius: 5px;
        cursor: pointer;
    }

    .inventory-new {
        display: none;
    }

    .inventory-photo-zoom {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        align-items: center;
        justify-content: center;
        z-index: 200;
    }

    .inventory-photo-zoom img {
        max-width: 80%;
        max-height: 80%;
        border: 3px solid #E3D3AC;
        border-radius: 5px;
        cursor: pointer;
    }


</style>

<script>

    $(document).ready(function() {

        $('#inventory-button').click(function() {
            $('#inventory-panel').fadeIn(200);
        });

        $('#close-inventory').click(function() {
            $('#inventory-panel').fadeOut(200);
        });

        $(document).on('click', '#inventory-letter', function() {
            $('#inventory-letter-zoom').css('display', 'flex');
        });

        $(document).on('click', '#inventory-photograph', function() {
            $('#inventory-photo-zoom').css('display', 'flex');
        });

        $('#inventory-photo-zoom').click(function() {
            $(this).fadeOut(300);
        });


        $('#inventory-letter-zoom').click(function() {
            $(this).fadeOut(300);
        });
    });

</script>