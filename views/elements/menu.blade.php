<!-- Open the modal using ID.showModal() method -->
<script>
  document.addEventListener("keydown", (event) => {
    // Detect "Ctrl + S"
    if ((event.ctrlKey || event.altKey) && event.key === "m") {
      event.preventDefault(); // Prevent default browser behavior
      menu_modal.showModal();
    }
  });
</script>
<dialog id="menu_modal" class="modal">
  <div class="modal-box bg-transparent shadow-none relative min-w-full">
    <h3 class="text-lg pixel -translate-y-5 absolute left-28">MENU</h3>
    <div class="bg-base-100 rounded-lg grid max-h-96 overflow-scroll p-4 gap-4">
      <a
        href="/forum"
        class="bg-primary rounded-lg min-h-32 flex justify-center items-center text-sm">
        <p class="pixel">Forum</p>
      </a>
      <a
        href="/staff"
        class="bg-primary rounded-lg min-h-32 flex justify-center items-center text-sm">
        <p class="pixel">Staff</p>
      </a>
      <a
        href="/news"
        class="bg-primary rounded-lg min-h-32 flex justify-center items-center text-sm">
        <p class="pixel">News</p>
      </a>
      <a
        href="/bans"
        class="bg-primary rounded-lg min-h-32 flex justify-center items-center text-sm">
        <p class="pixel">Forum</p>
      </a>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </div>
</dialog>
