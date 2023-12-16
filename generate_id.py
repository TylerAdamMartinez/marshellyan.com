import uuid
import base64

def safe_base64_encode(uuid_bytes):
    # Base64 URL encode the UUID
    encoded = base64.urlsafe_b64encode(uuid_bytes).decode('utf-8')
    
    # Remove '-' and '_' characters, as well as padding '='
    safe_encoded = encoded.replace('-', '').replace('_', '').rstrip('=')
    
    return safe_encoded

# Generate a UUID v4
generated_uuid = uuid.uuid4()

# Convert UUID to a byte array
uuid_bytes = generated_uuid.bytes

# Safe Base64 URL encode the UUID
encoded_uuid = safe_base64_encode(uuid_bytes)

# Print the encoded UUID
print(encoded_uuid[:12])
