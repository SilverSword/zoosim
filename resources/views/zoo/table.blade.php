<table  class="table table-striped table-hover table-condensed">
        <thead>
        <tr>
            <th data-field="name">Name</th>
            <th data-field="health">Health&nbsp;(%)</th>
            <th data-field="status">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($animals as $animal)
        <tr>
            <td>{{$animal->specie->name}}</td>
            <td>{{$animal->current_health * 100}}</td>
            <td>
                @if ($animal->is_dead)
                    <span class="label label-danger">Dead</span>
                @else
                    <span class="label label-success">Alive</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
