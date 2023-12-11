use markdown;
use std::os::raw::c_char;
use std::ffi::CString;

#[no_mangle]
pub extern "C" fn compile(_uuid: *const c_char) -> *const c_char {
    let html = markdown::to_html("__I am markdown__");
    let c_string = CString::new(html).unwrap();
    c_string.into_raw()
}

#[cfg(test)]
mod tests {
    use super::*;
    use std::ffi::{CString, CStr};

    #[test]
    fn it_works() {
        // Convert the input string to a CString, and then to a pointer
        let input = CString::new("fkdj").expect("CString::new failed");
        let input_ptr = input.as_ptr();

        // Call the compile function
        let result_ptr = compile(input_ptr);

        // Convert the raw pointer back to a Rust CStr
        let c_str = unsafe { CStr::from_ptr(result_ptr) };
        let result_str = c_str.to_string_lossy().into_owned();

        // Compare the result
        assert_eq!(result_str, "<p><strong>I am markdown</strong></p>\n");

        // Important: Free the memory allocated by compile
        unsafe {
            let _ = CString::from_raw(result_ptr as *mut c_char);
        }
    }
}

