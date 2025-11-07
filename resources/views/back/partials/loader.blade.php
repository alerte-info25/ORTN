<div id="loader">
    <div class="loader-content">
        <div class="loader-icon">
            @if (file_exists(public_path('storage/ORTNlogo.jpg')))
                <img src="{{  asset('storage/ORTNlogo.jpg') }}" alt="Logo Hayba" style="width:450px; height:250px; object-fit:contain;">
            @else
                <i class="fas fa-broadcast-tower"></i>
            @endif
        </div>
        <div class="loader-text">ORTN</div>
        <div class="loader-subtext" style="color: #fff">Office de Radio et télévision de Ngazidja</div>
        <div class="progress-bar">
            <div class="progress" id="loadingProgress"></div>
        </div>
    </div>
</div>