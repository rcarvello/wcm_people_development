
(function (global) {
  'use strict';

  var log = function () {},
      padding = '=',
      chrTable = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' +
                 '0123456789+/',
      binTable = [
        -1,-1,-1,-1, -1,-1,-1,-1, -1,-1,-1,-1, -1,-1,-1,-1,
        -1,-1,-1,-1, -1,-1,-1,-1, -1,-1,-1,-1, -1,-1,-1,-1,
        -1,-1,-1,-1, -1,-1,-1,-1, -1,-1,-1,62, -1,-1,-1,63,
        52,53,54,55, 56,57,58,59, 60,61,-1,-1, -1, 0,-1,-1,
        -1, 0, 1, 2,  3, 4, 5, 6,  7, 8, 9,10, 11,12,13,14,
        15,16,17,18, 19,20,21,22, 23,24,25,-1, -1,-1,-1,-1,
        -1,26,27,28, 29,30,31,32, 33,34,35,36, 37,38,39,40,
        41,42,43,44, 45,46,47,48, 49,50,51,-1, -1,-1,-1,-1
      ];

  if (global.console && global.console.log) {
    log = function (message) {
      global.console.log(message);
    };
  }

  // internal helpers //////////////////////////////////////////////////////////

  function utf8Encode(str) {
    var bytes = [], offset = 0, length, char;

    str = encodeURI(str);
    length = str.length;

    while (offset < length) {
      char = str[offset];
      offset += 1;

      if ('%' !== char) {
        bytes.push(char.charCodeAt(0));
      } else {
        char = str[offset] + str[offset + 1];
        bytes.push(parseInt(char, 16));
        offset += 2;
      }
    }

    return bytes;
  }

  function utf8Decode(bytes) {
    var chars = [], offset = 0, length = bytes.length, c, c2, c3;

    while (offset < length) {
      c = bytes[offset];
      c2 = bytes[offset + 1];
      c3 = bytes[offset + 2];

      if (128 > c) {
        chars.push(String.fromCharCode(c));
        offset += 1;
      } else if (191 < c && c < 224) {
        chars.push(String.fromCharCode(((c & 31) << 6) | (c2 & 63)));
        offset += 2;
      } else {
        chars.push(String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63)));
        offset += 3;
      }
    }

    return chars.join('');
  }

  // public api ////////////////////////////////////////////////////////////////

  function encode(str) {
    var result = '',
        bytes = utf8Encode(str),
        length = bytes.length,
        i;

    // Convert every three bytes to 4 ascii characters.
    for (i = 0; i < (length - 2); i += 3) {
      result += chrTable[bytes[i] >> 2];
      result += chrTable[((bytes[i] & 0x03) << 4) + (bytes[i+1] >> 4)];
      result += chrTable[((bytes[i+1] & 0x0f) << 2) + (bytes[i+2] >> 6)];
      result += chrTable[bytes[i+2] & 0x3f];
    }

    // Convert the remaining 1 or 2 bytes, pad out to 4 characters.
    if (length%3) {
      i = length - (length%3);
      result += chrTable[bytes[i] >> 2];
      if ((length%3) === 2) {
        result += chrTable[((bytes[i] & 0x03) << 4) + (bytes[i+1] >> 4)];
        result += chrTable[(bytes[i+1] & 0x0f) << 2];
        result += padding;
      } else {
        result += chrTable[(bytes[i] & 0x03) << 4];
        result += padding + padding;
      }
    }

    return result;
  }

  function decode(data) {
    var value, code, idx = 0,
        bytes = [],
        leftbits = 0, // number of bits decoded, but yet to be appended
        leftdata = 0; // bits decoded, but yet to be appended

    // Convert one by one.
    for (idx = 0; idx < data.length; idx++) {
      code = data.charCodeAt(idx);
      value = binTable[code & 0x7F];

      if (-1 === value) {
        // Skip illegal characters and whitespace
        log("WARN: Illegal characters (code=" + code + ") in position " + idx);
      } else {
        // Collect data into leftdata, update bitcount
        leftdata = (leftdata << 6) | value;
        leftbits += 6;

        // If we have 8 or more bits, append 8 bits to the result
        if (leftbits >= 8) {
          leftbits -= 8;
          // Append if not padding.
          if (padding !== data.charAt(idx)) {
            bytes.push((leftdata >> leftbits) & 0xFF);
          }
          leftdata &= (1 << leftbits) - 1;
        }
      }
    }

    // If there are any bits left, the base64 string was corrupted
    if (leftbits) {
      log("ERROR: Corrupted base64 string");
      return null;
    }

    return utf8Decode(bytes);
  }

  global.base64 = {encode: encode, decode: decode};
}(window));


////////////////////////////////////////////////////////////////////////////////
// vim:ts=2:sw=2
////////////////////////////////////////////////////////////////////////////////
