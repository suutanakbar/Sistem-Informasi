#!/bin/bash

echo "========================================="
echo "  Fix Storage & File Upload Issues"
echo "========================================="
echo ""

# Check if we're in a Laravel project
if [ ! -f "artisan" ]; then
    echo "❌ Error: This script must be run from the Laravel project root directory"
    exit 1
fi

echo "✓ Laravel project detected"
echo ""

# Step 1: Create storage symlink
echo "📁 Step 1: Creating storage symbolic link..."
if [ -L "public/storage" ]; then
    echo "  ⚠️  Symlink already exists, removing and recreating..."
    rm public/storage
fi

php artisan storage:link

if [ -L "public/storage" ]; then
    echo "  ✓ Storage symlink created successfully"
else
    echo "  ❌ Failed to create storage symlink"
    exit 1
fi
echo ""

# Step 2: Set proper permissions
echo "🔒 Step 2: Setting folder permissions..."

# Set storage directory permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set public directory permissions
chmod -R 775 public

echo "  ✓ Permissions set for storage, bootstrap/cache, and public directories"
echo ""

# Step 3: Clear cache
echo "🗑️  Step 3: Clearing Laravel cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "  ✓ Cache cleared"
echo ""

# Step 4: Verify .env configuration
echo "⚙️  Step 4: Checking .env configuration..."
if [ -f ".env" ]; then
    APP_URL=$(grep "^APP_URL=" .env | cut -d'=' -f2)
    FILESYSTEM_DISK=$(grep "^FILESYSTEM_DISK=" .env | cut -d'=' -f2)
    
    echo "  Current APP_URL: $APP_URL"
    echo "  Current FILESYSTEM_DISK: $FILESYSTEM_DISK"
    
    if [ "$FILESYSTEM_DISK" != "public" ]; then
        echo "  ⚠️  Warning: FILESYSTEM_DISK is set to '$FILESYSTEM_DISK', should be 'public'"
        echo "     Consider changing it in .env file:"
        echo "     FILESYSTEM_DISK=public"
    else
        echo "  ✓ FILESYSTEM_DISK is correctly set to 'public'"
    fi
else
    echo "  ⚠️  Warning: .env file not found. Please create one from .env.example"
fi
echo ""

# Step 5: Verify storage link
echo "🔍 Step 5: Verifying storage link..."
if [ -L "public/storage" ]; then
    TARGET=$(readlink public/storage)
    echo "  ✓ public/storage -> $TARGET"
    
    if [ -d "public/storage" ]; then
        echo "  ✓ Symlink is working correctly"
    else
        echo "  ❌ Symlink target directory does not exist"
    fi
else
    echo "  ❌ Storage symlink not found"
fi
echo ""

echo "========================================="
echo "  ✅ Fix completed!"
echo "========================================="
echo ""
echo "Next steps:"
echo "1. Make sure your .env has the correct APP_URL (e.g., http://your-domain.com)"
echo "2. Restart your web server (Apache/Nginx)"
echo "3. Clear browser cache and test file upload again"
echo ""
echo "If images still don't show:"
echo "- Check browser console for 404 errors"
echo "- Verify the file exists in storage/app/public/[folder]/[filename]"
echo "- Check web server error logs"
echo ""