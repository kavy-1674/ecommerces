// Toaster.js - Reusable Toast Notification System

class Toaster {
    constructor() {
        this.createToastContainer();
        this.toastDuration = 4000; // 4 seconds default
    }

    createToastContainer() {
        if (!document.getElementById('toast-container')) {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
            `;
            document.body.appendChild(container);
        }
    }

    show(message, type = 'info', duration = null) {
        const toast = this.createToast(message, type);
        const container = document.getElementById('toast-container');
        container.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
            toast.style.opacity = '1';
        }, 100);

        // Auto remove
        const removeTime = duration || this.toastDuration;
        setTimeout(() => {
            this.removeToast(toast);
        }, removeTime);
    }

    createToast(message, type) {
        const toast = document.createElement('div');
        const icons = {
            success: '✓',
            error: '✕',
            warning: '⚠',
            info: 'ℹ'
        };
        
        const colors = {
            success: '#10B981',
            error: '#EF4444',
            warning: '#F59E0B',
            info: '#3B82F6'
        };

        toast.style.cssText = `
            background: white;
            border-left: 4px solid ${colors[type]};
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 16px 20px;
            min-width: 300px;
            max-width: 400px;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        `;

        toast.innerHTML = `
            <div style="
                width: 24px;
                height: 24px;
                border-radius: 50%;
                background: ${colors[type]};
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
                font-weight: bold;
                flex-shrink: 0;
            ">${icons[type]}</div>
            <div style="flex: 1;">
                <div style="
                    font-weight: 600;
                    color: #1F2937;
                    margin-bottom: 4px;
                    font-size: 14px;
                ">${this.getTitle(type)}</div>
                <div style="
                    color: #6B7280;
                    font-size: 13px;
                    line-height: 1.4;
                ">${message}</div>
            </div>
            <button onclick="toaster.removeToast(this.parentElement)" style="
                background: none;
                border: none;
                color: #9CA3AF;
                cursor: pointer;
                padding: 4px;
                border-radius: 4px;
                font-size: 18px;
                line-height: 1;
                margin-left: 8px;
                transition: color 0.2s ease;
            " onmouseover="this.style.color='#6B7280'" onmouseout="this.style.color='#9CA3AF'">×</button>
        `;

        return toast;
    }

    getTitle(type) {
        const titles = {
            success: 'Success!',
            error: 'Error!',
            warning: 'Warning!',
            info: 'Info'
        };
        return titles[type] || 'Info';
    }

    removeToast(toast) {
        toast.style.transform = 'translateX(100%)';
        toast.style.opacity = '0';
        setTimeout(() => {
            if (toast.parentElement) {
                toast.parentElement.removeChild(toast);
            }
        }, 300);
    }

    // Convenience methods
    success(message, duration) {
        this.show(message, 'success', duration);
    }

    error(message, duration) {
        this.show(message, 'error', duration);
    }

    warning(message, duration) {
        this.show(message, 'warning', duration);
    }

    info(message, duration) {
        this.show(message, 'info', duration);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const toaster = new Toaster();
    window.toaster = toaster;
});
