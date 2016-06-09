<script>
    $(document).ready(function(){
        $("#contrato_select").change(function(){
            search_contratos();
        })

        search_contratos();
    })

</script>

<div class="span12">
    <label for="contratos" class="control-label" >
        Elija contrato
    </label>

    <select class="form-control" name="contrato" id="contrato_select">
    <?php
        if($contratos!=""){
        foreach ($contratos as $data) {
    ?>
            <option  value="<?php echo $data['codigo'] ?>"><?php echo $data['contrato'] ?></option>

    <?php
        }

    }

    ?>


</div>