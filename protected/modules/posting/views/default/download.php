<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}" width='135' height='91'></a>
            {% } %}</td>
            <td class="name">
                <input class="photodescription" type="text" id="PostMainPhoto_description_{%=file.photo_id%}" name="Post[photoDescription]" value="{%=file.title%}">
                <br><br>
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
        {% } %}
        <td> 
            <input type="hidden" id="Post_photoId" name="Post[photoId]" value="{%=file.photo_id%}" >
        </td>
        
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" type="button">
                <i class="icon-trash icon-white"></i>
                <!--<span>{%/*=locale.fileupload.destroy*/%}</span>-->
                <span>Удалить</span>
            </button>
        </td>
    </tr>
{% } %}
</script>