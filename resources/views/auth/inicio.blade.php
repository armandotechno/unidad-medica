<h3>Estás logueado</h3>

<form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: inline;">
    @csrf
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off"></i>
        Salir
    </a>
</form>
