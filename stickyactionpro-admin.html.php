<div class="admin-panel">
    <div class="groups">
        <div class="group">
            <label for="bgcolor">Choose a Background color:</label>
            <input type="color" id="bgcolor" value="<?= $bgcolor ?>" name="bgcolor">
        </div>
        <div class="group">
            <label for="txtcolor">Choose a Text color:</label>
            <input type="color" id="txtcolor" value="<?= $txtcolor ?>" name="txtcolor">
        </div>
    </div>
    <div class="group">
        <label for="size">Size : (<?= $size ?>px)</label>
        <input type="range" id="size" value="<?= $size ?>" name="size" min="13" max="30" />
    </div>

    <!-- Repeated Block -->
    <div id="blocks-container">
        <?php foreach ($blocks as $key => $block):?>
            <div class="block show">
                <div class="remove">
                    <button class="remove-btn" onclick="removeBlock(this)"><i class="fa-solid fa-xl fa-close"></i></button>
                </div>
                <div class="groups">
                    <div class="group">
                        <input type="text" class="title" value="<?= $block['title'] ?>"  onclick="openWPLink(<?= $key ?>)" id="text_<?= $key ?>" onkeyup="preview()" readonly="" placeholder="text" name="text[]">
                    </div>
                    <div class="group">
                        
                        <input type="url" class="link" value="<?= $block['link'] ?>" onclick="openWPLink(<?= $key ?>)" id="url_<?= $key ?>" onkeyup="preview()" readonly="" placeholder="text" name="url[]">
                    </div>
                    <div class="group">
                        <button style="color:<?= $txtcolor ?>;background-color:<?= $bgcolor ?>;border-color:<?= $txtcolor ?>" type="button" class="GetIconPicker" data-iconpicker-input="input.IconInput<?= $key ?>"><i class="<?= $block['icon'] ?>"></i></button>
                        <input type="hidden" class="IconInput<?= $key ?> icon" value="<?= $block['icon'] ?>" name="icon[]">
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
    <div class="add">
        <!-- Add Button -->
        <button class="add-btn" onclick="addBlock()">
            <i class="fa-solid  fa-circle-plus"></i>
            &nbsp;Add Block
        </button>
        <!-- Add Button -->
        <button class="add-btn save-btn" onclick="saveAction()">
            <i class="fa-solid fa-floppy-disk"></i>
            &nbsp;Save
        </button>
    </div>
    <div class="preview"></div>
</div>

