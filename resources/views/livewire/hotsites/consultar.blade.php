<div class="row boxes">
    <div class="col-3 box">
        <a href="https://curso.7seventrends.com/model01" target="_blank">
            <img src="{{ asset('/imagems/hotsites/image 139.jpg') }}" alt="">
            <h2>Exemplo Hotsite 1</h2>
        </a>
    </div>

    <div class="col-3 box">
        <a href="https://curso.7seventrends.com/model02" target="_blank">
            <img src="{{ asset('/imagems/hotsites/image 139.jpg') }}" alt="">
            <h2>Exemplo Hotsite 2</h2>
        </a>
    </div>
</div>


@push('styles')
    <style>
        .boxes {
            justify-content: space-around
        }

        .box {
            background-color: #e2e2e2; 
            padding: 0;
        }

        .box a {
            text-align: center;
            display: flex;
            flex-direction: column;
            transition: .3s;
        }

        .box a:hover {
            background-color: var(--azul);
            transform: scale(1.04);
        }
        .box a:hover h2 {
            color: #fff;
        }

        .box a h2 {
            margin: 1.5rem 0;
            transition: .3s;
        }

    </style>
@endpush
