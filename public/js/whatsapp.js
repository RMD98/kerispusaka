function sendWhatsAppMessage() {
    const phoneNumber = "6283163374681"; // Replace with your number
    const message = "Mohon lakuan pemeriksaan pada ternak dengan ID 12345"; // Replace with your message
    const encodedMessage = encodeURIComponent(message);
    const isMobile = /iPhone|Android|iPad|iPod/i.test(navigator.userAgent);
    const baseUrl = isMobile 
      ? `https://wa.me/${phoneNumber}?text=${encodedMessage}`  // Use this on mobile (opens app)
      : `https://web.whatsapp.com/send?phone=${phoneNumber}&text=${encodedMessage}`;  // Use this on desktop

    // const fullUrl = `${baseUrl}`;
    window.open(baseUrl, '_blank');
}
