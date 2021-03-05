<div class="border">
  <span class=" f-30">
    <span id="copy_link">
      {{url('/')}}?ref={{$user->id}}
    </span>
    <i class="fas fa-copy cursor_pointer" title="Copy" @click="$root.copy(' {{url('/')}}?ref={{$user->id}} ')"></i>
  </span>
</div>
