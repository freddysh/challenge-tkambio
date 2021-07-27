<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="tipo_cambios"
      :line-numbers="true"
      :pagination-options="{
                enabled: true,
                mode: 'records',
                perPage: 10,
                position: 'botton',
                perPageDropdown: [10, 15, 20, 25, 50],
                dropdownAllowAll: true,
                setCurrentPage: 1,
                nextLabel: 'Siguiente',
                prevLabel: 'Previo',
                rowsPerPageLabel: 'Filas por pagina',
                ofLabel: 'de',
                pageLabel: 'pagina', // for 'pages' mode
                allLabel: 'Todos',
                infoFn: (params) => `${params.totalRecords} registros`,
            }"
      :search-options="{
                enabled: true
            }"
    >
      <template
        slot="table-row"
        slot-scope="props"
      >

        <span v-if="props.column.field == 'fecha'">
          {{moment(props.row.fecha).format('DD/MM/YYYY') }}
        </span><span v-if="props.column.field == 'tc_venta'">
          {{props.row.tc_venta}}
        </span><span v-if="props.column.field == 'tc_compra'">
          {{props.row.tc_compra}}
        </span>
        <span v-if="props.column.field == 'created_at'">
          {{moment(props.row.created_at).format('D MMMM YYYY, h:mm:ss a') }}
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tipo_cambios: [],
      columns: [
        {
          field: "fecha",
          label: "Fecha"
        },
        {
          field: "tc_compra",
          label: "Tc Compra"
        },
        {
          field: "tc_venta",
          label: "Tc Venta"
        },
        {
          field: "created_at",
          label: "Creado"
        }
      ]
    };
  },
  created() {
    this.getTipoCambios();
  },

  methods: {
    getTipoCambios() {
      axios.get(`../api/v1/tipo-cambio`).then(res => {
        this.tipo_cambios = res.data;
        this.tipo_cambios.sort(function(a, b) {
          if (a.created_at > b.created_at) {
            return 1;
          }
          if (a.created_at < b.created_at) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
      });
    }
  }
};
</script>
