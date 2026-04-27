    </main> <!-- End of content-area -->
</div> <!-- End of main-wrapper -->

<script>
    // Subtle hover effect for mesh background
    document.addEventListener('mousemove', (e) => {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;
        document.querySelector('.mesh-bg').style.transform = `translate(${x * 20}px, ${y * 20}px)`;
    });
</script>

</body>
</html>
