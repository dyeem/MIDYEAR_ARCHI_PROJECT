document.getElementById('adminSelect').addEventListener('change', function() {
    const adminNav = document.getElementById('adminNav');
    console.log('Select changed, toggling class');
    adminNav.classList.toggle('moved-down');
    console.log('Current classes on adminNav:', adminNav.className);
});