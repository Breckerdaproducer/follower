<?php




// Enhanced accounts query with improved multi-term search functionality
if (!empty($search_query)) {
    // Split search query into individual terms
    $search_terms = array_filter(array_map('trim', explode(' ', $search_query)));

    if (!empty($search_terms)) {
        // Build dynamic WHERE clause for multiple terms
        $where_conditions = [];
        $bind_params = [];
        $bind_types = '';

        foreach ($search_terms as $term) {
            // Each term should match at least one field
            $term_condition = "(
                username LIKE ? OR 
                platform LIKE ? OR 
                location LIKE ? OR 
                s_1 LIKE ? OR 
                s_2 LIKE ? OR 
                s_3 LIKE ? OR 
                CAST(followers AS CHAR) LIKE ? OR 
                CAST(price AS CHAR) LIKE ?
            )";

            $where_conditions[] = $term_condition;

            // Add the term 8 times for each field check
            $search_param = "%{$term}%";
            for ($i = 0; $i < 8; $i++) {
                $bind_params[] = $search_param;
                $bind_types .= 's';
            }
        }

        // Join all conditions with AND (all terms must match)
        $where_clause = implode(' AND ', $where_conditions);

        $accounts_sql = "SELECT * FROM accounts WHERE {$where_clause} ORDER BY followers DESC";
        $accounts = $conn->prepare($accounts_sql);

        if (!empty($bind_params)) {
            $accounts->bind_param($bind_types, ...$bind_params);
        }
    } else {
        // Fallback to show all if no valid terms
        $accounts = $conn->prepare('SELECT * FROM accounts ORDER BY followers DESC');
    }
} else {
    // Default query to show all accounts
    $accounts = $conn->prepare('SELECT * FROM accounts ORDER BY followers DESC');
}

$accounts->execute();
$accounts = $accounts->get_result();

// Alternative approach: More flexible search with keyword matching
function searchAccountsFlexible($conn, $search_query)
{
    if (empty($search_query)) {
        $accounts = $conn->prepare('SELECT * FROM accounts ORDER BY followers DESC');
        $accounts->execute();
        return $accounts->get_result();
    }

    // Split search into terms
    $search_terms = array_filter(array_map('trim', explode(' ', strtolower($search_query))));

    if (empty($search_terms)) {
        $accounts = $conn->prepare('SELECT * FROM accounts ORDER BY followers DESC');
        $accounts->execute();
        return $accounts->get_result();
    }

    // Get all accounts first
    $all_accounts = $conn->prepare('SELECT * FROM accounts ORDER BY followers DESC');
    $all_accounts->execute();
    $all_accounts_result = $all_accounts->get_result();

    $matching_accounts = [];

    while ($account = $all_accounts_result->fetch_assoc()) {
        $account_text = strtolower(
            $account['username'] . ' ' .
            $account['platform'] . ' ' .
            $account['location'] . ' ' .
            $account['s_1'] . ' ' .
            $account['s_2'] . ' ' .
            $account['s_3'] . ' ' .
            $account['followers'] . ' ' .
            $account['price']
        );

        // Check if all search terms are found in the account text
        $all_terms_found = true;
        foreach ($search_terms as $term) {
            if (strpos($account_text, $term) === false) {
                $all_terms_found = false;
                break;
            }
        }

        if ($all_terms_found) {
            $matching_accounts[] = $account;
        }
    }

    return $matching_accounts;
}
?>