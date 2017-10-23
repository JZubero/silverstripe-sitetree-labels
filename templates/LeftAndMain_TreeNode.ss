<li id="record-$ID" data-id="$ID" data-pagetype="$ClassName" class="$Classes"><ins class="jstree-icon">&nbsp;</ins>
    <a href="$Link" title="$Title.ATT"><ins class="jstree-icon">&nbsp;</ins>
        <span class="text">$TreeTitle</span>
        <% if $SiteTreeLabels %>
            <% loop $SiteTreeLabels %>
                <span class="sitetree-label" style="background-color: $Color">$Title</span>
            <% end_loop %>
        <% end_if %>
    </a>
</li>