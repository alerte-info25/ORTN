document.addEventListener('DOMContentLoaded', function() {
    // Animation d'apparition progressive
    const elements = document.querySelectorAll('.success-icon, .success-title, .success-subtitle, .confirmation-message, .event-card, .confirmation-details, .actions-container');
    
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 200);
    });
    
    // Fonction de génération du QR Code
    function generateQRCode(text, size = 200) {
        const tempDiv = document.createElement('div');
        new QRCode(tempDiv, {
            text: text,
            width: size,
            height: size,
            colorDark: '#003366',
            colorLight: '#ffffff',
        });
        const qrCanvas = tempDiv.querySelector('canvas');
        return qrCanvas.toDataURL('image/png');
    }
    
    // Fonction de téléchargement du billet en PDF
    function downloadTicket() {
        // Récupérer les données depuis la page
        const eventTitle = document.querySelector('.event-title').textContent.trim();
        const eventDate = document.querySelector('.event-meta-item:nth-child(1) span').textContent.trim();
        const eventVenue = document.querySelector('.event-meta-item:nth-child(2) span').textContent.trim();
        const transactionId = document.querySelectorAll('.detail-value')[0].textContent.trim();
        const transactionDate = document.querySelectorAll('.detail-value')[1].textContent.trim();
        const amount = document.querySelectorAll('.detail-value')[2].textContent.trim();
        const status = document.querySelectorAll('.detail-value')[3].textContent.trim();
        const email = document.querySelectorAll('.receipt-value')[2].textContent.trim();
        
        // Créer un canvas pour le billet
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        
        // Dimensions du billet (format A4 en pixels à 96 DPI)
        canvas.width = 794;
        canvas.height = 1123;
        
        // Fond blanc
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // En-tête avec dégradé
        const gradient = ctx.createLinearGradient(0, 0, canvas.width, 100);
        gradient.addColorStop(0, '#003366');
        gradient.addColorStop(1, '#2D8659');
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, canvas.width, 100);
        
        // Logo ORTN (texte)
        ctx.fillStyle = '#FFD700';
        ctx.font = 'bold 36px Arial';
        ctx.textAlign = 'center';
        ctx.fillText('ORTN', canvas.width/2, 60);
        
        // Titre du billet
        ctx.fillStyle = '#003366';
        ctx.font = 'bold 32px Arial';
        ctx.fillText('BILLET D\'ENTRÉE', canvas.width/2, 160);
        
        // Ligne de séparation
        ctx.strokeStyle = '#FFD700';
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.moveTo(100, 190);
        ctx.lineTo(canvas.width - 100, 190);
        ctx.stroke();
        
        // Informations de l'événement
        ctx.fillStyle = '#003366';
        ctx.font = 'bold 24px Arial';
        ctx.textAlign = 'left';
        ctx.fillText('Événement', 100, 240);
        
        ctx.font = '20px Arial';
        ctx.fillStyle = '#333333';
        const maxWidth = canvas.width - 200;
        wrapText(ctx, eventTitle, 100, 280, maxWidth, 30);
        
        // Date et lieu
        ctx.fillStyle = '#003366';
        ctx.font = 'bold 20px Arial';
        ctx.fillText('Date & Heure', 100, 360);
        ctx.font = '18px Arial';
        ctx.fillStyle = '#333333';
        ctx.fillText(eventDate, 100, 390);
        
        ctx.fillStyle = '#003366';
        ctx.font = 'bold 20px Arial';
        ctx.fillText('Lieu', 100, 440);
        ctx.font = '18px Arial';
        ctx.fillStyle = '#333333';
        wrapText(ctx, eventVenue, 100, 470, maxWidth, 25);
        
        // QR Code
        const qrSize = 200;
        const qrX = (canvas.width - qrSize) / 2;
        const qrY = 550;
        
        // Cadre pour le QR code
        ctx.fillStyle = '#f8f9fa';
        ctx.fillRect(qrX - 20, qrY - 20, qrSize + 40, qrSize + 40);
        ctx.strokeStyle = '#003366';
        ctx.lineWidth = 2;
        ctx.strokeRect(qrX - 20, qrY - 20, qrSize + 40, qrSize + 40);
        
        // QR Code (simulé)
        const qrCode = generateQRCode(transactionId, qrSize);
        const img = new Image();
        img.onload = function() {
            ctx.drawImage(img, qrX, qrY, qrSize, qrSize);
            
            // Texte sous le QR code
            ctx.fillStyle = '#666666';
            ctx.font = 'italic 16px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('Scannez ce code à l\'entrée', canvas.width/2, qrY + qrSize + 50);
            
            // Détails de la transaction
            ctx.fillStyle = '#003366';
            ctx.font = 'bold 20px Arial';
            ctx.textAlign = 'left';
            ctx.fillText('Détails de la transaction', 100, 850);
            
            ctx.font = '16px Arial';
            ctx.fillStyle = '#333333';
            ctx.fillText(`Référence: ${transactionId}`, 100, 885);
            ctx.fillText(`Date: ${transactionDate}`, 100, 915);
            ctx.fillText(`Montant: ${amount}`, 100, 945);
            ctx.fillText(`Email: ${email}`, 100, 975);
            ctx.fillText(`Statut: ${status}`, 100, 1005);
            
            // Pied de page
            ctx.fillStyle = '#f8f9fa';
            ctx.fillRect(0, canvas.height - 80, canvas.width, 80);
            
            ctx.fillStyle = '#666666';
            ctx.font = '14px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('Présentez ce billet à l\'entrée de l\'événement', canvas.width/2, canvas.height - 45);
            ctx.fillText('Pour toute question, contactez support@ortn.ci', canvas.width/2, canvas.height - 20);
            
            // Télécharger le billet
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = `Billet-${transactionId}.png`;
                link.click();
                URL.revokeObjectURL(url);
            });
        };
        img.src = qrCode;
    }
    
    // Fonction pour wrapper le texte
    function wrapText(ctx, text, x, y, maxWidth, lineHeight) {
        const words = text.split(' ');
        let line = '';
        let currentY = y;
        
        for (let i = 0; i < words.length; i++) {
            const testLine = line + words[i] + ' ';
            const metrics = ctx.measureText(testLine);
            const testWidth = metrics.width;
            
            if (testWidth > maxWidth && i > 0) {
                ctx.fillText(line, x, currentY);
                line = words[i] + ' ';
                currentY += lineHeight;
            } else {
                line = testLine;
            }
        }
        ctx.fillText(line, x, currentY);
    }
    
    // Gestionnaire de téléchargement
    document.querySelector('.btn-primary').addEventListener('click', function(e) {
        e.preventDefault();
        
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Génération du billet...';
        this.disabled = true;
        
        setTimeout(() => {
            downloadTicket();
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-check"></i> Téléchargé !';
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 2000);
            }, 500);
        }, 1000);
    });
    
    // Gestionnaire de retour
    document.querySelector('.btn-outline').addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = '/evenements'; // Ajustez cette URL selon votre routing
    });
});