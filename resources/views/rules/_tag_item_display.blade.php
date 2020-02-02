<div class="child_tag__wrapper mb-2 p-2 font-weight-bold border border-secondary bg-primary text-white">
    @{{tag.name}}
</div>

<div class="cursor_pointer" v-for="childTag in childTags(tag.id)" @click="onTagClick(childTag)">
    <div class="child_tag__wrapper mb-2 p-2 border border-secondary">
        <div class="font-weight-bold">
            @{{childTag.name}}
        </div>
        <div class="">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </div>
    </div>
</div>
