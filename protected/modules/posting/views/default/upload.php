<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name">
            <span>{%=file.name%}</span>
            <br>
            <span>{%=o.formatFileSize(file.size)%}</span>
            {% if (o.files.valid && !i) { %}
                <br>
                <div class="progress progress-success progress-striped active" >
                    <div class="bar" style="width:0%;"></div>
                </div>
            {% } %}
        </td>
        
        {% if (file.error) { %}
            <td class="error" colspan="2">
                <span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}
            </td>
        {% } else if (o.files.valid && !i) { %}
            {% if (!o.options.autoUpload) { %}
                <td class="start">
                    <button class="btn btn-primary" type="submit">
                        <i class="icon-upload icon-white"></i>
                        <span>Загрузка</span>
                    </button>
                </td>
            {% } %}
            {% if (!i) { %}
                <td class="cancel">
                    <button class="btn btn-warning" type="button">
                        <i class="icon-ban-circle icon-white"></i>
                        <span>Отмена</span>
                    </button>
                </td>
            {% } %}
        {% } else { %}
            <td class="cancel">
                {% if (!i) { %}
                    <button class="btn btn-warning" type="button">
                        <i class="icon-ban-circle icon-white"></i>
                        <span>Отмена</span>
                    </button>
                {% } %}
            </td>
        {% } %}
    </tr>
{% } %}
</script>
