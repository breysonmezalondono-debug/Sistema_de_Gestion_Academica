<div class="table-responsive">
    <table class="table-modern {{ $class ?? '' }}">
        <thead>
            <tr>
                {{ $headers }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
